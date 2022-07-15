SELECT us.name, us.email, cat.name, te.name, te.zipcode, zc.town, zc.state
FROM
    teams te,
    categories cat,
    users us,
    zipcodes zc
WHERE
    cat.id = te.category_id
    AND us.id = te.user_id
    AND zc.zipcode = te.zipcode
ORDER BY us.name, cat.name
    /* Equipos cuyo usuario no ha aceptado deslinde de responsabilidades */
SELECT us.name, us.email, cat.name, te.name, te.zipcode, zc.town, zc.state
FROM
    teams te,
    categories cat,
    users us,
    zipcodes zc
WHERE
    cat.id = te.category_id
    AND us.id = te.user_id
    AND zc.zipcode = te.zipcode
    AND us.accept_responsibilities IS NULL
ORDER BY us.name, cat.name

/ /
SELECT us.name, us.phone, cat.name, te.name, zip.town, zip.state, pay.amount / pay.source as Pagado
FROM
    users us
    LEFT JOIN teams as te ON us.id = te.user_id
    LEFT JOIN categories cat ON cat.id = te.category_id
    LEFT JOIN zipcodes zip ON zip.zipcode = te.zipcode
    LEFT JOIN payments pay ON pay.id = te.payment_id
WHERE
    us.id NOT IN(1, 2, 3)
ORDER BY us.name, cat.name, te.name

/ / Usuarios y Pagos
SELECT us.name, pa.* / /
SELECT
    us.name,
    us.phone,
    cat.name,
    te.name,
    zip.town,
    zip.state,
    pay.amount / pay.source as Pagado,
    if(
        us.accept_responsibilities IS NOT NULL, "SI", "NO"
    ) as DESILNDE
FROM users us
    LEFT JOIN payments as pa ON us.id = pa.user_id

/ / Equipos reservados por categoría
SELECT cat.name, sum(tc.qty_teams) as reservados, sum(tc.registered_teams) as registrados
FROM
    categories as cat,
    team_categories as tc
WHERE
    cat.id = tc.category_id
GROUP BY
    cat.name
ORDER BY cat.name

/ / Consulta general de Coach, Team

SELECT
    usu.name as COACH,
    usu.phone as PHONE,
    usu.email as MAIL,
    cat.name AS CATEGORY,
    tea.name as TEAM,
    pla.first_name as PLAYER,
    pla.last_name as LAST_NAME,
    pla.birthday AS BIRTHDAY,
    if(
        pla.gender = 'Male', "BOY", "GIRL"
    ) as GENDER,
    if(
        usu.accept_responsibilities is NOT NULL, "SI", "NO"
    ) as ACCEPT_DESLINDE / / Equipos sacados con
UNION
SELECT
    usu.name as COACH,
    usu.phone as PHONE,
    cat.name AS CATEGORY,
    tea.name as TEAM,
    zip.town as TOWN,
    zip.state as STATE,
    pay.amount / pay.source as Pagado
FROM
    users usu,
    categories cat,
    teams as tea,
    zipcodes zip,
    payments pay
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND pay.id = tea.payment_id
    AND zip.zipcode = tea.zipcode
    AND usu.id NOT IN(1, 2, 3)
UNION
SELECT
    usu.name as COACH,
    usu.phone as PHONE,
    cat.name AS CATEGORY,
    tea.name as TEAM,
    zip.town as TOWN,
    zip.state as STATE,
    "NO" as Pagado
FROM
    users usu,
    categories cat,
    teams as tea,
    zipcodes zip
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND zip.zipcode = tea.zipcode
    AND usu.id NOT IN(1, 2, 3)
SELECT
    usu.name as COACH,
    usu.phone as PHONE,
    cat.name AS CATEGORY,
    tea.name as TEAM,
    zip.town as TOWN,
    zip.state as STATE,
    "NO" as Pagado,
    if(
        us.accept_responsibilities is NOT NULL, "SI", NO
    ) as ACCEPT_DESLINDE
FROM
    users usu,
    categories cat,
    teams as tea,
    zipcodes zip
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND zip.zipcode = tea.zipcode
    AND usu.id NOT IN(1, 2, 3)

/ / Jugadores

<< << << < HEAD
SELECT
    usu.name as COACH,
    usu.phone as PHONE,
    cat.name AS CATEGORY,
    tea.name as TEAM,
    pla.first_name as PLAYER,
    pla.last_name as LAST_NAME,
    pla.birthday AS BIRTHDAY,
    if(
        pla.gender = 'Male', "BOY", "GIRL"
    ) as GENDER
FROM
    users usu,
    categories cat,
    teams as tea,
    players pla,
    player_team plt
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND pla.id = plt.player_id
    AND tea.id = plt.team_id
    AND usu.id NOT IN(1, 2, 3)
ORDER BY CATEGORY, TEAM, PLAYER, COACH
ORDER BY
    COACH,
    CATEGORY,
    TEAM,
    PLAYER = = = = = = =
SELECT
    usu.name as COACH,
    usu.phone as PHONE,
    cat.name AS CATEGORY,
    tea.name as TEAM,
    pla.first_name as PLAYER,
    pla.last_name as LAST_NAME,
    pla.birthday AS BIRTHDAY,
    if(
        pla.gender = 'Male', "BOY", "GIRL"
    ) as GENDER,
    if(
        usu.accept_responsibilities is NOT NULL, "SI", "NO"
    ) as ACCEPT_DESLINDE
FROM
    users usu,
    categories cat,
    teams as tea,
    players pla,
    player_team plt
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND pla.id = plt.player_id
    AND tea.id = plt.team_id
    AND usu.id NOT IN(1, 2, 3)
ORDER BY CATEGORY, TEAM, PLAYER, COACH

/ / COACHES - CATEGORIA
SELECT
    cat.name as CATEGORY,
    tea.name as TEAM,
    usu.name as COACH,
    usu.email as EMAIL,
    usu.phone AS PHONE,
    if(
        tea.payment_id IS NULL, "NO", "SI"
    ) as pago,
    if(
        usu.accept_responsibilities IS NOT NULL, "SI", "NO"
    ) as DESLINDE
FROM
    users usu,
    categories cat,
    teams tea
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id

SELECT
    cat.name AS CATEGORY,
    tea.name as TEAM,
    usu.name as COACH,
    usu.phone as PHONE,
    pla.first_name as PLAYER,
    pla.last_name as LAST_NAME,
    pla.birthday AS BIRTHDAY,
    if(
        pla.gender = 'Male', "BOY", "GIRL"
    ) as GENDER,
    if(
        usu.accept_responsibilities is NOT NULL, "SI", "NO"
    ) as ACCEPT_DESLINDE,
    count(*) as Total
FROM
    users usu,
    categories cat,
    teams as tea,
    players pla,
    player_team plt
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND pla.id = plt.player_id
    AND tea.id = plt.team_id
    AND usu.id NOT IN(1, 2, 3)
ORDER BY CATEGORY, TEAM, PLAYER, COACH
GROUP BY
    category,
    team,
    coach,
    phone,
    player

/ / RESUMEN TOTAL JUGADORES POR QUIPO
FROM
    users usu,
    categories cat,
    teams as tea,
    players pla,
    player_team plt
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND pla.id = plt.player_id
    AND tea.id = plt.team_id
    AND usu.id NOT IN(1, 2, 3)
GROUP BY
    category,
    team,
    coach,
    phone

TOTAL DE JUGADORES X Equipos
SELECT
    cat.name as category,
    tea.name as team,
    usu.name as coach,
    usu.email as email,
    count(*) as total,
    if(
        tea.payment_id IS NULL, "NO", "SI"
    ) as PAGO,
    if(
        usu.accept_responsibilities IS NOT NULL, "SI", "NO"
    ) as DESLINDE
FROM
    categories cat,
    teams tea,
    users usu,
    players pla,
    player_team plt
WHERE
    usu.id = tea.user_id
    AND cat.id = tea.category_id
    AND tea.id = plt.team_id
    AND pla.id = plt.player_id
GROUP BY
    category,
    team,
    coach,
    email

TOTAL JUGADORES POR Equipos

SELECT
    cat.name as CATEGORIA,
    te.name as EQUIPO,
    us.name as COACH,
    us.email as CORREO,
    us.phone as TELEFONO,
    COUNT(*) as JUGADORES,
    pay.amount / pay.source as Pagado,
    if(
        us.accept_responsibilities IS NOT NULL, "SI", "NO"
    ) as DESILNDE
FROM
    users us
    LEFT JOIN teams as te ON us.id = te.user_id
    LEFT JOIN categories cat ON cat.id = te.category_id
    LEFT JOIN zipcodes zip ON zip.zipcode = te.zipcode
    LEFT JOIN payments pay ON pay.id = te.payment_id
    LEFT JOIN player_team plt ON plt.team_id = te.id
    LEFT JOIN players pla ON pla.id = plt.player_id
WHERE
    us.id NOT IN(1, 2, 3)
GROUP BY
    categoria,
    equipo,
    coach,
    correo,
    telefono >> >> >> > d28447ab (Actualización a Conultas)
