DROP TABLE transactions; DROP TABLE wallets; DROP TABLE users; DROP TABLE currency_rates;
CREATE TABLE IF NOT EXISTS `users`
(
    `id`           int NOT NULL AUTO_INCREMENT,
    `name`         varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `currency_rates`
(
    `id`           int NOT NULL AUTO_INCREMENT,
    `currency`     varchar(5) NOT NULL,
    `rate`         double NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `wallets`
(
    `id`           int NOT NULL AUTO_INCREMENT,
    `user_id`      int NOT NULL,
    `currency`     int NOT NULL,
    `balance`      double NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (currency) REFERENCES currency_rates(id) ON DELETE CASCADE,
    INDEX USING BTREE (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `transactions`
(
    `id`           int NOT NULL AUTO_INCREMENT,
    `wallet_id`    int NOT NULL,
    `amount`       double NOT NULL,
    `type`         varchar(255) NOT NULL,
    `reason`       varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`wallet_id`) REFERENCES wallets(`id`) ON DELETE CASCADE,
    INDEX USING BTREE (`wallet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (name) VALUES ('Vladimir');
INSERT INTO currency_rates (currency, rate) VALUES ('RUB', 1.0);
INSERT INTO currency_rates (currency, rate) VALUES ('USD', 70.1);
INSERT INTO wallets (user_id, currency, balance) VALUES (1, 1, 0);
