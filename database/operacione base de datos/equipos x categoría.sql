SELECT us.name,us.email,cat.name,te.name,te.zipcode,zc.town,zc.state
FROM teams te,categories cat,users us,zipcodes zc
WHERE cat.id = te.category_id
  AND us.id = te.user_id
  AND zc.zipcode = te.zipcode
ORDER BY us.name,cat.name

/* Equipos cuyo usuario no ha aceptado deslinde de responsabilidades */
SELECT us.name,us.email,cat.name,te.name,te.zipcode,zc.town,zc.state
FROM teams te,categories cat,users us,zipcodes zc
WHERE cat.id = te.category_id
  AND us.id = te.user_id
  AND zc.zipcode = te.zipcode
  AND us.accept_responsibilities IS NULL
ORDER BY us.name,cat.name
