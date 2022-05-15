<?php

namespace App\Service;

use App\Entity\Salary;
use App\Repository\SalaryRepository;

class Calculate
{
    // 1 МРП
    const MINIMUM_CALC_INDICATOR = 3180;

    // 25 МРП
    const MINIMUM_SALARY_MONTH = 25 * Calculate::MINIMUM_CALC_INDICATOR;

    // 882 МРП
    const EXCESS_SALARY = 882 * Calculate::MINIMUM_CALC_INDICATOR;

    private $salaryRepository;

    public function __construct(SalaryRepository $salaryRepository)
    {
        $this->salaryRepository = $salaryRepository;
    }

    public function calculate(\App\Entity\Calculate $calculate, $method = 'GET'): Salary
    {
        // Сумма зарплаты в день
        $salaryNormDay = $calculate->getNorm() / $calculate->getNormOfDays();

        // Зарплата в месяц
        $salaryMonth = $salaryNormDay * $calculate->getWorkedOfDays();

        $taxDeduction = 0;
        if ($calculate->isIsTaxDeduction()) {
            $taxDeduction = Calculate::MINIMUM_CALC_INDICATOR;
        }

        // Обязательные пенсионные взносы (ОПВ)
        $opv = $salaryMonth * 0.1;

        // Взносы на обязательное социальное медицинское Страхование (ВОСМС)
        $vosms = $salaryMonth * 0.02;

        // Обязательное социальное медицинское страхование (ОСМС)
        $osms = $salaryMonth * 0.02;

        // Социальные отчисления (СО)
        $so = ($salaryMonth- $opv) * 0.035;

        // Расчет корректировки
        $adjustment = 0;

        // Если заработная плата за месяц меньше 25 МРП, срабатывает корректировка;
        if ($salaryMonth < Calculate::MINIMUM_SALARY_MONTH) {
            $adjustment = ($salaryMonth - $opv - $taxDeduction - $vosms) * 0.9;
        }

        // Индивидуальный подоходный налог (ИПН)
        $ipn = ($salaryMonth - $opv - $taxDeduction - $vosms - $adjustment) * 0.1;

        $salaryInHand = $salaryMonth - $ipn - $opv - $vosms - $osms - $so;

        if ($calculate->isIsRetired()) {
            // Пенсионер с инвалидностью не облагается налогами;
            if ($calculate->getDisabledGroup()) {
                $salaryInHand = $salaryMonth;
            } else {
                //Пенсионер облагается лишь ИПН;
                $salaryInHand = $salaryMonth - $ipn;
            }
        } elseif ($calculate->getDisabledGroup()) {
            $salaryInHand = $salaryMonth;

            if (in_array($calculate->getDisabledGroup(), [1, 2])) {
                // Инвалид 1 и 2 группы облагается лишь СО;
                $salaryInHand = $salaryInHand - $so;
            } elseif ($calculate->getDisabledGroup() == 3) {
                // Инвалид 3 группы облагается ОПВ и СО;
                $salaryInHand = $salaryInHand - $opv - $so;
            }

            // Если ЗП у инвалида превысила 882 МРП, он облагается ИПН
            if ($salaryMonth > Calculate::EXCESS_SALARY) {
                $salaryInHand = $salaryInHand - $ipn;
            }
        }

        $salary = new Salary();
        $salary->setCalculate($calculate);
        $salary->setAdjustment($adjustment);
        $salary->setIpn($ipn);
        $salary->setOpv($opv);
        $salary->setOsms($osms);
        $salary->setSalaryInHand($salaryInHand);
        $salary->setSo($so);
        $salary->setVosms($vosms);

        if ($method == 'POST') {
            $this->salaryRepository->add($salary, true);
        }

        return $salary;
    }
}
