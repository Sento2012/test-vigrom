Тестовое задание.

Для запуска выполнить команду `make install` из корневой папки

Для добавления новой транзакции для пользователя необходимо выполнить из консоли: `curl -X POST "http://localhost:8000/transaction" --data "amount=1.0&type=debit&currency=rub&reason=stock&wallet_id=1"` 
Возможные значения для валют: rub, usd
Возможные значения для type: debit, credit
Возможные значения для reason: stock, refund

Для получения текущего баланса кошелька необходимо выполнить из консоли: `curl -X GET "http://localhost:8000/wallet/1"`

Запрос на получение суммы транзакций за последние 7 дней:
`SELECT sum(amount) FROM transactions WHERE create_at > DATE(DATE_SUB(NOW(), INTERVAL 7 DAY)) AND reason = 'refund';;`