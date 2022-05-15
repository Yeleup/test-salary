# Тестовое задание для PHP разработчика - «Зарплатный калькулятор»

Реализовать 2 end point-а, которые принимают на вход следующие значения:
1. Оклад в тенге
2. Норма дней в месяц (обычно 22)
3. Отработанное количество дней
4. Имеется ли налоговый вычет 1 МЗП
5. Календарный год
6. Календарный месяц
8. Является ли сотрудник пенсионером
9. Является ли сотрудник инвалидом, если да, то какой группы.

Первый end point «calculate» будет возвращать результат калькуляции в ответе, без сохранения данных.
Второй end point на POST будет создавать запись о начислении зарплаты, в ответе вернуть результат сохранения (калькуляцию)

Зарплата облагается следующими налогами:
1. Индивидуальный подоходный налог (ИПН)
2. Обязательные пенсионные взносы (ОПВ)
3. Обязательное социальное медицинское страхование (ОСМС)
4. Взносы на обязательное социальное медицинское cтрахование (ВОСМС)
5.Социальные отчисления (СО)

Данные, которые должен вернуть API: Налоги (выше перечисленные), зарплата на руки (сумма за вычетом налогов, которые удерживаются с сотрудника), начисленная зарплата.

Формулы и условия расчёта значений:
* ИПН = ЗП – ОПВ – 1МЗП (при наличии вычета) – ВОМСМ – Корректировка (при наличии, об этом ниже) * 10%; Если заработная плата за месяц меньше 25 МРП, срабатывает корректировка;
* Расчет корректировки (ЗП - ОПВ - 1МЗП (при наличии вычета) - ВОСМС) * 90%;
* ОПВ = ЗП * 10%;
* ВОСМС = ЗП * 2%;
* ОСМС = ЗП * 2%;
* СО = (ЗП-ОПВ) * 3,5%
* Пенсионер облагается лишь ИПН;
* Пенсионер с инвалидностью не облагается налогами;
* Инвалид 1 и 2 группы облагается лишь СО;
* Инвалид 3 группы облагается ОПВ и СО;
* Если ЗП у инвалида превысила 882 МРП, он облагается ИПН;

Всё расчёты производятся для сотрудника ИП с трудовым договором.
При проектировании базы данных, заложить возможность расширения функционала «калькулятор отпуска»

```
Задача была реализована с помощью PHP 8 и фреймворка Symfony 6
```
