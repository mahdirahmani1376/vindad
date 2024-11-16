use vindad;

CREATE TABLE IF NOT EXISTS posts (
                                         id  INT PRIMARY KEY auto_increment,
                                         title VARCHAR(255) NOT NULL,
                                         content VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
                                     id  INT PRIMARY KEY auto_increment
);

# question 2 answer
# we need to create a separate variations table in order to store the
# repeatable data and have a normalized databases structure
CREATE TABLE IF NOT EXISTS products (
                                     id  INT PRIMARY KEY auto_increment,
                                     category_id INT,
                                    variation_id INT
);

Create TABLE IF NOT EXISTS variation (
                                         id  INT PRIMARY KEY auto_increment,
                                         product_id INT,
    size tinytext null,
    color tinytext null,
    width int null,
    height int null,
    depth int null
)
