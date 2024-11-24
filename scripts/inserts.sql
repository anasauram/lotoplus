use lotoplusdb;
-- Relación de nombres con contraseñas originales antes del hash de los 10 primeros usuarios insertados:
-- ('Juan', 'Pérez López', 'juanp') -> Contraseña original: 'clave123'
-- ('María', 'González Torres', 'mariagt') -> Contraseña original: 'mypass123'
-- ('Pedro', 'Martínez Díaz', 'pedromd') -> Contraseña original: 'securepass'
-- ('Ana', 'Fernández Ruiz', 'anafr') -> Contraseña original: 'password'
-- ('Carlos', 'Hernández Vega', 'carlosv') -> Contraseña original: 'clave654'
-- ('Lucía', 'Morales Ortega', 'luciam') -> Contraseña original: 'lucypass'
-- ('Miguel', 'Suárez Pérez', 'miguels') -> Contraseña original: 'mypass456'
-- ('Laura', 'Gómez Sánchez', 'laurags') -> Contraseña original: 'password123'
-- ('Sofía', 'Castillo Pérez', 'sofiacp') -> Contraseña original: 'sofiapass'
-- ('Luis', 'Díaz Romero', 'luisdr') -> Contraseña original: 'passluis'
INSERT INTO usuarios (nombre, apellidos, nomusu, clave, email, tel, ganancias, fechanac, imgusu, tipocu, marketing, tipousu, validada)
VALUES
('Juan', 'Pérez López', 'juanp', '$2y$10$Z1eOfLZ0K4nFn0V/WQHnOeWuWBG9J0X5i4xoIjxFvFt.wuFpaFM2G', 'juanp@gmail.com', '600123456', 100, '1985-03-10', 'juanp.png', 'Gratuita', 'S', 'n', 'S'),
('María', 'González Torres', 'mariagt', '$2y$10$y7mTjx2F4ZcHQ2zPKP6Fmu8Ax62RuDXTjYQt.CPIFJiwK7.rLYoZC', 'mariagt@hotmail.com', '610987654', 0, '1990-05-15', NULL, 'Suscripción', 'N', 'a', 'S'),
('Pedro', 'Martínez Díaz', 'pedromd', '$2y$10$09mrLIkGyfxYZ53JdRg.qeHf0MPXG/v9HcCLXUOtuOpZPfhs0DLcG', 'pedromd@yahoo.com', '622345678', 0, '1980-07-21', 'pedro.jpg', 'Gratuita', 'S', 'n', 'N'),
('Ana', 'Fernández Ruiz', 'anafr', '$2y$10$qDlmK52vTVy3IZt5.lRmDeawzVVZUwFeKuXBc3Wqs.ZCFECu8uFQC', 'anafr@outlook.com', '634567890', 200, '1995-10-10', 'anafr.jpeg', 'Gratuita', 'S', 'n', 'S'),
('Carlos', 'Hernández Vega', 'carlosv', '$2y$10$yD29/eEBo.Mc9.jF6FojNe.8f7shHbXM6KY4m0wXODhYbcF6YYKuG', 'carlosv@gmail.com', '640567890', 0, '1987-12-05', 'carlos.jpg', 'Suscripción', 'N', 'a', 'S'),
('Lucía', 'Morales Ortega', 'luciam', '$2y$10$rFj4rAEjNnRpHbI66DeuCu3DD/N1ndLBDN6soA3ZK/umEQtjVR5lC', 'luciam@gmail.com', '650123789', 50, '1992-02-25', NULL, 'Gratuita', 'S', 'n', 'N'),
('Miguel', 'Suárez Pérez', 'miguels', '$2y$10$a2xxC1O2d4lh7fWXHs6CceHQNL5bTqZaMd7NYoxLUlmGsZmIlGpQy', 'miguels@yahoo.com', '670234123', 10, '1989-11-30', 'miguel.jpg', 'Suscripción', 'S', 'a', 'S'),
('Laura', 'Gómez Sánchez', 'laurags', '$2y$10$t9HIh/H7LfN9YXrRHhDAbOmuV6YfUNRoQk/N5GRTPIVF3XtMn.Hli', 'laurags@hotmail.com', '680345456', 0, '2000-08-12', NULL, 'Gratuita', 'N', 'n', 'N'),
('Sofía', 'Castillo Pérez', 'sofiacp', '$2y$10$.wQs0Fi1Y/yU.CJJ/2.aXeHGkBXusV.k90I3swhsfANJNZRhh7Nc2', 'sofiacp@gmail.com', '690456789', 120, '1993-03-05', 'sofia.png', 'Suscripción', 'S', 'a', 'S'),
('Luis', 'Díaz Romero', 'luisdr', '$2y$10$TBdX0uoHl3v2Xy4nlTiwA.KnMcN09RLuJx09Hd.aOxwX28kAZRgO6', 'luisdr@outlook.com', '699567890', 0, '1985-01-17', NULL, 'Gratuita', 'N', 'n', 'S'),
('Ricardo', 'Pérez Sánchez', 'ricardops', '$2y$10$C4G2pI4RSoC0Vczm5e8NqaPiAh0gFDI.dqofJhdV0Y7XpB42oNe1yi', 'ricardops@gmail.com', '600123457', 150, '1991-06-21', 'ricardops.png', 'Gratuita', 'S', 'n', 'S'),
('Elena', 'Ramírez Gómez', 'elenarg', '$2y$10$JiV8bXKnvSHdOg3j6rpOiwS6KDiJfbz4uyW2IOf9tXAYuHRcmkBq2u', 'elenarg@gmail.com', '610987655', 0, '1988-11-10', NULL, 'Suscripción', 'N', 'n', 'S'),
('Carlos', 'López Fernández', 'carloslf', '$2y$10$Fh2HhT3vU02ikb3bf8J8TadZ6KhOTGE.b5eFQtXYkOFiw0V91NdpSe', 'carloslf@yahoo.com', '620234568', 300, '1992-01-18', 'carloslf.jpg', 'Gratuita', 'S', 'n', 'N'),
('Beatriz', 'Mendoza Ruiz', 'beatrizmr', '$2y$10$CdqRpZXo6OgrIMhwQGyFPdDYOym4YYmjKw9EV0nQzoC9vsVt5lT6h', 'beatrizmr@hotmail.com', '630345678', 25, '1985-07-30', 'beatrizmr.png', 'Suscripción', 'S', 'a', 'S'),
('Alejandro', 'Gómez Romero', 'alexgr', '$2y$10$kYhQmAe7T6x9ZY7WjA2X/eY9fJHHZpv20J6cF8H2BFpBwshtQJq6J', 'alexgr@gmail.com', '640567891', 100, '1994-03-23', 'alexgr.jpg', 'Gratuita', 'S', 'n', 'S'),
('Raquel', 'Martínez Torres', 'raquelmt', '$2y$10$uFm1uDjo23aykZa7yVKMG9yXRPtn1exHRDyyF5ZBr5sf2zfpnqbH1', 'raquelmt@yahoo.com', '650123790', 70, '1990-05-18', 'raquelmt.png', 'Suscripción', 'S', 'n', 'S'),
('José', 'González Ruiz', 'josegr', '$2y$10$PxFNtRfmXn8MShyFC6gF9o9Grc4eq9xndtWkjf2YjXIqOlRoxPZ9ee', 'josegr@gmail.com', '660234124', 10, '1987-10-03', 'josegr.jpg', 'Gratuita', 'S', 'n', 'S'),
('Fernando', 'Hernández González', 'fernandhg', '$2y$10$2h4s2rt9Y17xTfDNi5qym6Z5F2T1v06zdFLrAiiwCFIYX3l8d0gz7', 'fernandhg@hotmail.com', '670345457', 45, '1991-02-12', 'fernandhg.jpg', 'Gratuita', 'S', 'n', 'S'),
('Laura', 'Suárez Pérez', 'laurasp', '$2y$10$D.YFfK5sllLgIXQg2kDQJf5LCdb5lX9rfLmdw8Zy0Be5iwhBhJ7fq', 'laurasp@yahoo.com', '680456789', 120, '1993-06-15', 'laurasp.png', 'Suscripción', 'N', 'n', 'S'),
('David', 'Castro López', 'davidcl', '$2y$10$MtGhxa8Lr5vppKtDp6gVt2msqlnFVlKmR3Hzdfx98OhYjR7CZqAK0', 'davidcl@hotmail.com', '690567890', 65, '1988-12-09', 'davidcl.jpg', 'Gratuita', 'S', 'n', 'S'),
('Cristina', 'Jiménez Fernández', 'cristinajf', '$2y$10$P0IhgsbM1GnhXvY7DGHfDeO7Ozk5b6rIzFFXZyL5mhBwfRJGGzUJd', 'cristinajf@gmail.com', '700123789', 180, '1990-08-11', 'cristinajf.png', 'Suscripción', 'S', 'a', 'S'),
('Javier', 'Mora Ruiz', 'javiermr', '$2y$10$4Gj3wZsm6OBV9fF7Fj.sGYNszdIl1B6MkAEqZTzklQhUtgy2cfRTq', 'javiermr@yahoo.com', '710234125', 85, '1988-12-09', 'javiermr.jpg', 'Gratuita', 'N', 'n', 'S'),
('Sandra', 'Pérez Hernández', 'sandraph', '$2y$10$s1kRIzxu6xk0sdR16nMvKjvqRyyA61d5pZ78KjThS3cfYHgYAYlQ2', 'sandraph@hotmail.com', '720345458', 50, '1994-11-03', 'sandraph.png', 'Suscripción', 'S', 'n', 'S'),
('Tomás', 'Rodríguez García', 'tomasrg', '$2y$10$CImTz5P0TkUB8jHq0vxtjR9u6f88PQkIWkxqVg2yIHxQXq.NFjXhR', 'tomasrg@gmail.com', '730456789', 200, '1986-01-21', 'tomasrg.jpg', 'Gratuita', 'N', 'n', 'S'),
('Rosa', 'Sánchez García', 'rosasg', '$2y$10$X9YHv3GhxGp9ryoQsBGr3pwZfXxhDbjFP3gnRkOUocDz7V9mPslT8', 'rosasg@yahoo.com', '740567890', 500, '1993-09-27', 'rosasg.jpg', 'Suscripción', 'S', 'a', 'S'),
('Ricardo', 'Vázquez Torres', 'ricardovt', '$2y$10$3JqNz88.N6TifkHtH8UvgIWmV1tLFNYnlG82hx02kUN2sq5ofbUuO', 'ricardovt@hotmail.com', '750678901', 300, '1992-05-16', 'ricardovt.png', 'Gratuita', 'S', 'n', 'S'),
('Silvia', 'Ramos Martínez', 'silviar', '$2y$10$s1kRIzxu6xk0sdR16nMvKjvqRyyA61d5pZ78KjThS3cfYHgYAYlQ2', 'silviar@gmail.com', '760789012', 60, '1991-07-13', 'silviar.jpg', 'Suscripción', 'N', 'n', 'S'),
('Pedro', 'Vega Ruiz', 'pedrovru', '$2y$10$iwffFfAgcge03O3qQmfL8lzydUhvAvlnchFHvKFbqGxMbbYxk1lF2', 'pedrovru@yahoo.com', '770890123', 15, '1985-09-10', 'pedrovru.png', 'Gratuita', 'S', 'n', 'S'),
('María', 'Soto Pérez', 'mariasp', '$2y$10$z2bpnHHW9lDgfWcuw6p2tXYqioAvvUE60mpSifKc9Fw1zClVya.TK', 'mariasp@gmail.com', '780901234', 32, '1990-12-05', 'mariasp.jpg', 'Suscripción', 'S', 'n', 'S'),
('Juan', 'González Castro', 'juangc', '$2y$10$Msnm9yXPHGl6bXMwwzlnW91r4jiQzy3wh9wQw2VNO.ejHOocM8pBW', 'juangc@yahoo.com', '790234567', 45, '1993-04-04', 'juangc.png', 'Gratuita', 'S', 'n', 'S'),
('Ana', 'Díaz Pérez', 'anadp', '$2y$10$Lpz97XzFq9KbEwb5h3r2vDt6.k51hwA40zSTN9LMJThMtiGoqIKvpy', 'anadp@hotmail.com', '800345678', 100, '1986-06-23', 'anadp.jpg', 'Suscripción', 'S', 'n', 'S'),
('Marcos', 'Torres Ramírez', 'marcostr', '$2y$10$C5yCz1ft.z7eUGv7db1cHR5tZNmKfXIimXofge6wLZXzWe38x93IK', 'marcostr@gmail.com', '810456789', 85, '1990-03-12', 'marcostr.png', 'Gratuita', 'S', 'n', 'S'),
('Pedro', 'Suárez Pérez', 'pedrosu', '$2y$10$BWloTpL4eeQt0tbhKk4HR2WoF5bI9i8vMn53fZcs6fzoWi1tb6ax6', 'pedrosu@yahoo.com', '820567890', 400, '1989-08-09', 'pedrosu.jpg', 'Suscripción', 'N', 'a', 'S'),
('Lucía', 'Méndez Rodríguez', 'luciamr', '$2y$10$ZXtDQks9OTvIjNf6ySYZZvN7uFX3b.TZdu0ZwepmbsyfiH5BPAwZq', 'luciamr@gmail.com', '830678901', 30, '1991-02-18', 'luciamr.png', 'Gratuita', 'N', 'n', 'S'),
('Carlos', 'López Martínez', 'carloslm', '$2y$10$VW07vDWZz5GBXTSFIMPSmiXeCzKPB9lD9f9ppg7beAFot24ivmIiYW', 'carloslm@gmail.com', '600112233', 50, '1988-01-15', 'carloslm.png', 'Gratuita', 'S', 'n', 'S'),
('Ana', 'Rodríguez Sánchez', 'anaros', '$2y$10$KuAmEj1oT77gLXol4jeD9xCVVowUw/o8oZTALONwzJAFZzF8OnbLu', 'anaros@hotmail.com', '610223344', 150, '1992-03-25', 'anaros.jpg', 'Suscripción', 'S', 'n', 'S'),
('David', 'Gómez Pérez', 'davidgp', '$2y$10$1B5gItAfI5D1X3zV0.m7ZxqTPryNxvYGRR4BQhsBYy5d1lVfDpFqq', 'davidgp@yahoo.com', '620334455', 200, '1985-04-12', 'davidgp.png', 'Gratuita', 'S', 'n', 'S'),
('Laura', 'Mendoza Díaz', 'lauramd', '$2y$10$E5qgW7BdUw36N3j61CejU/qgsnChXCrV1ENk9Vtb7pBHOvSEjufHG', 'lauramd@gmail.com', '630445566', 300, '1989-07-05', 'lauramd.jpg', 'Suscripción', 'S', 'a', 'S'),
('Luis', 'Martínez García', 'luismg', '$2y$10$y4pk5rJ9gUyDpdgjYxgEwm.CU2wR6UEfMbbxenNTQ7EolRiDrm3cu', 'luismg@hotmail.com', '640556677', 100, '1993-02-28', 'luismg.png', 'Gratuita', 'S', 'n', 'N'),
('Isabel', 'Vega Sánchez', 'isabelvs', '$2y$10$B5c5ZcXjFT65dF5/0S0sO9Cvh1Uu1RfLpk7uTk5rkF6qKebJS2OqK', 'isabelvs@gmail.com', '650667788', 50, '1990-12-10', 'isabelvs.png', 'Suscripción', 'S', 'a', 'N'),
('José', 'Pérez Jiménez', 'josep', '$2y$10$pb2XtMv7UEe7vO2mSIm8hRsPjtUOWb0OlkAEz7lUo3N1F4oVY54Dq', 'josep@yahoo.com', '660778899', 0, '1987-06-20', 'josep.jpg', 'Gratuita', 'S', 'n', 'S'),
('Sofía', 'Jiménez Muñoz', 'sofiajm', '$2y$10$1C88.HPq6lIKHFG2rq9R0sqJqHrWBpd9xaHVy59Cw2EBJ9VG6ps2o', 'sofiajm@hotmail.com', '670889900', 250, '1995-11-30', 'sofiajm.png', 'Gratuita', 'S', 'n', 'S'),
('Javier', 'Torres López', 'javiert', '$2y$10$gbDGEU1Hh0b6dKBR5jlZz57rtOblRsZ20KqGGzMAtTeR8azocN.0W', 'javiert@gmail.com', '680990011', 0, '1991-09-14', 'javiert.jpg', 'Suscripción', 'S', 'n', 'S'),
('Raúl', 'Gutiérrez Navarro', 'raulgn', '$2y$10$B9Pmt6psGiStE15gQ1BzL4gYA2Z4NUsAWilEAZpZIkWcbCwUVLfvi', 'raulgn@yahoo.com', '690101122', 50, '1994-02-05', 'raulgn.jpg', 'Gratuita', 'S', 'n', 'N'),
('Marta', 'Vázquez Ramos', 'martavr', '$2y$10$gYXYz.jMROfQxaF0DgsgoGBJm4ANhT.5vs5H52rQ1t6fCwsHwPnQK', 'martavr@gmail.com', '700212233', 150, '1986-08-15', 'martavr.png', 'Suscripción', 'S', 'a', 'S'),
('Ricardo', 'López García', 'ricardolg', '$2y$10$eiET3MzF5VrfMkY6XQ1J0d7RHl0C1Y/mtU3QowZhv7L5lfA9MtqOq', 'ricardolg@yahoo.com', '710323344', 200, '1983-04-22', 'ricardolg.png', 'Gratuita', 'S', 'n', 'S'),
('Pablo', 'González Martín', 'pablom', '$2y$10$u7DT67HFM5MiCVYNrX2Jq6H8FfTcBoCSXlk91pVvOESgkk4W3G9Mi', 'pablom@hotmail.com', '720434455', 50, '1993-11-03', 'pablom.jpg', 'Suscripción', 'S', 'n', 'N'),
('Elena', 'Jiménez Fernández', 'elenajf', '$2y$10$HqYfI4Xfu4Xv3VQb7feNU0q9ihQmSxL6wMB7t1RzZy5vYINnUMJKm', 'elenajf@gmail.com', '730545566', 100, '1996-02-20', 'elenajf.jpg', 'Gratuita', 'S', 'n', 'S'),
('Antonio', 'Maldonado Sánchez', 'antonioms', '$2y$10$yI1SHu5OBFONlDiF7axXYUjpye3u8OKGb1vK2mXppN5l7vKv9qU9a', 'antonioms@yahoo.com', '740656677', 50, '1990-06-11', 'antonioms.png', 'Gratuita', 'S', 'a', 'S'),
('Carmen', 'Vidal Rodríguez', 'carmenvr', '$2y$10$w7lsVsdx3TxuYOImUwBxU0cXsSHtfa9ZOKRcykY1XAOc3HZ2A0J0W', 'carmenvr@hotmail.com', '750767788', 100, '1991-10-19', 'carmenvr.png', 'Suscripción', 'S', 'n', 'N'),
('Ricardo', 'Sánchez Ruiz', 'ricardosr', '$2y$10$TZp7GxhzD1r88hMjf.m9FVgFCETxBrJbS9/cmbmfw5zDmbjchfF1G', 'ricardosr@gmail.com', '760878899', 150, '1984-05-30', 'ricardosr.jpg', 'Gratuita', 'S', 'n', 'S'),
('Verónica', 'Díaz Fernández', 'veronicadf', '$2y$10$ssZ6cSpE5cHKWwwu49Bl2NAtYukg30ukqJvFh3WTMGJlYTLZ7uBzO', 'veronicadf@yahoo.com', '770989900', 200, '1992-01-25', 'veronicadf.png', 'Suscripción', 'S', 'n', 'S'),
('Eduardo', 'Torres García', 'eduardotg', '$2y$10$4lnQyAfl9c78jbmF9rIrMEFowJdAOV6Wgfg0YfczHbJbWz5PtaCBm', 'eduardotg@gmail.com', '780101011', 50, '1987-11-14', 'eduardotg.jpg', 'Gratuita', 'S', 'n', 'N'),
('Raquel', 'González Díaz', 'raquelgd', '$2y$10$M6sTRQJl2vWqj54X7bbdDK4cK8dKZxnTO9muQMFzNAtPRdYeRp2o2', 'raquelgd@gmail.com', '790212122', 300, '1994-08-13', 'raquelgd.jpg', 'Suscripción', 'S', 'a', 'S'),
('Miguel', 'López Pérez', 'miguellp', '$2y$10$4lxjHrF7URst9nQxIja61pH5HFdDd3zNjQZAB92EoZbLq37y5wC6z', 'miguellp@yahoo.com', '800323233', 0, '1989-05-04', 'miguellp.png', 'Gratuita', 'S', 'n', 'N'),
('Daniela', 'Sánchez Romero', 'danielasr', '$2y$10$T6Q9hTwKSt0vD9pEwYpWEF5/l.POzmAl2phOJkl3F1FwHVs5eKMdG', 'danielasr@gmail.com', '810434344', 150, '1996-09-18', 'danielasr.jpg', 'Suscripción', 'S', 'n', 'S'),
('Manuel', 'Ruiz Ortega', 'manuelro', '$2y$10$Tt7e8uwqqW27ddtQ5XqKqIcPHlbwTLjl6OaITApMC6.P6bxjXlO1S', 'manuelro@yahoo.com', '820545455', 100, '1985-03-09', 'manuelro.png', 'Gratuita', 'S', 'n', 'N'),
('Sandra', 'Pérez González', 'sandragp', '$2y$10$nvUbkVuK.TWdo9eF7ncuXq5wvqLirOpOF5tn74xZVpBQHhfS6yPTa', 'sandragp@gmail.com', '830656566', 50, '1986-12-30', 'sandragp.png', 'Suscripción', 'S', 'n', 'S'),
('Víctor', 'Santos Ruiz', 'victorsr', '$2y$10$ci8F5ppv9Fd3.AOXKms46ajkPlZdXPl.gZyifCXYkZp3tfsG24Elz', 'victorsr@yahoo.com', '840767676', 200, '1992-07-04', 'victorsr.jpg', 'Gratuita', 'S', 'n', 'S'),
('Celia', 'González Hernández', 'celiagh', '$2y$10$YoUmLfpu7NxFjDQnQceM8D3FJzTpqCz6d3OBldN.v76G2V.tRDeem', 'celiagh@gmail.com', '850878787', 150, '1991-10-18', 'celiagh.jpg', 'Suscripción', 'S', 'n', 'S'),
('Fernando', 'Torres Ruiz', 'fernandotr', '$2y$10$sqI68Nntd2l.m2VbJbTTNSKP1Vbg3vs52f6wINg7AMdkqKmXGp.n6', 'fernandotr@hotmail.com', '860989898', 100, '1995-01-10', 'fernandotr.png', 'Gratuita', 'S', 'a', 'S'),
('Patricia', 'Moreno Jiménez', 'patriciamj', '$2y$10$SHGbptnsbbp0yNwS15XlOQGVmB8i3VRD8eKAYBlIQuOt3Yn.jMKtW', 'patriciamj@yahoo.com', '870101909', 50, '1988-09-11', 'patriciamj.jpg', 'Suscripción', 'S', 'n', 'N'),
('Roberto', 'López Torres', 'robertolt', '$2y$10$ePNe4I9bHfB6pSx1nFZ2w4fDGFmltq3FZjZZ9yDytPzT.jzxeUm16', 'robertolt@hotmail.com', '880212020', 200, '1984-07-03', 'robertolt.png', 'Gratuita', 'S', 'n', 'S');


INSERT INTO sorteos (nsorteo, fsorteo, descrip)
VALUES
('SORTEO001', '2024-01-01', 'Sorteo de Año Nuevo'),
('SORTEO002', '2024-02-14', 'Sorteo de San Valentín'),
('SORTEO003', '2024-03-01', 'Sorteo de Primavera'),
('SORTEO004', '2024-04-10', 'Sorteo Especial de Pascua'),
('SORTEO005', '2024-05-01', 'Sorteo del Día del Trabajador'),
('SORTEO006', '2024-06-21', 'Sorteo de Verano'),
('SORTEO007', '2024-07-15', 'Sorteo de Verano Especial'),
('SORTEO008', '2024-08-01', 'Sorteo Vacacional'),
('SORTEO009', '2024-09-10', 'Sorteo de Otoño'),
('SORTEO010', '2024-12-25', 'Sorteo de Navidad');

INSERT INTO premios (idsorteo, numero, premio)
VALUES
(1, 12345, 50.00),
(1, 54321, 100.00),
(2, 23456, 75.00),
(2, 65432, 20.00),
(3, 34567, 50.00),
(4, 76543, 150.00),
(5, 45678, 30.00),
(6, 87654, 200.00),
(7, 56789, 50.00),
(8, 98765, 500.00);

INSERT INTO participaciones (idprop, idsorteo, numero, importe, captura)
VALUES
(1, 1, 12345, 10, 'captura1.png'),
(2, 2, 23456, 5, 'captura2.jpg'),
(3, 3, 34567, 2, 'captura3.pdf'),
(4, 4, 76543, 4, 'captura4.png'),
(5, 5, 45678, 8, 'captura5.jpg'),
(6, 6, 87654, 6, 'captura6.png'),
(7, 7, 56789, 3, 'captura7.pdf'),
(8, 8, 98765, 7, 'captura8.png'),
(9, 9, 12345, 9, 'captura9.jpg'),
(10, 10, 54321, 1, 'captura10.png');
