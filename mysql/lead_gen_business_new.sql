-- 1. What query would you run to get the total revenue for March of 2012?

SELECT MONTHNAME(charged_datetime) AS month, YEAR(charged_datetime) AS year, SUM(amount) AS revenue
FROM billings
WHERE charged_datetime BETWEEN '2012-03-01' AND '2012-03-31';


-- 2. What query would you run to get total revenue collected from client=2 ?

SELECT clients.id AS client_id, SUM(billings.amount) AS total_revenue FROM billings
JOIN clients ON clients.id = billings.client_id
WHERE clients.id = 2;


-- 3. What query would you run to get all the sites that client=10 owns?

SELECT sites.domain_name AS website, clients.id AS client_id FROM sites
JOIN clients ON clients.id = sites.client_id
WHERE clients.id = 10;


-- 4. What query would you run to get total # of sites created each month for client=1 ? What about for client=20?

-- for client=1
SELECT clients.id AS client_id, COUNT(sites.domain_name) AS number_of_website, 
MONTHNAME(sites.created_datetime) AS month_created, YEAR(sites.created_datetime) AS year_created 
FROM sites
JOIN clients ON clients.id = sites.client_id
WHERE clients.id = 1
GROUP BY MONTHNAME(created_datetime);

-- for client=20
SELECT clients.id AS client_id, COUNT(sites.domain_name) AS number_of_website, 
MONTHNAME(sites.created_datetime) AS month_created, YEAR(sites.created_datetime) AS year_created 
FROM sites
JOIN clients ON clients.id = sites.client_id
WHERE clients.id = 20
GROUP BY created_datetime;


-- 5. What query would you run to get the total # of leads we've generated for each of our sites 
-- between January 1st 2011 to February 15th 2011?

SELECT sites.domain_name AS website, COUNT(leads.id) AS number_of_leads FROM sites
LEFT JOIN leads ON leads.site_id = sites.id
WHERE registered_datetime BETWEEN '2011-01-01' AND '2011-02-15'
GROUP BY leads.id;


-- 6. What query would you run to get a list of client name and the total # of leads we've generated 
-- for each of our clients between January 1st 2011 to December 31st 2011?

SELECT GROUP_CONCAT(clients.first_name, ' ', clients.last_name) AS client_name, 
COUNT(leads.id) AS number_of_leads FROM clients
JOIN sites ON sites.client_id = clients.id
JOIN leads ON leads.site_id = sites.id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-12-31'
GROUP BY clients.id;


-- 7. What query would you run to get a list of client name and
-- the total # of leads we've generated for each client each month between month 1 - 6 of Year 2011?

SELECT GROUP_CONCAT(clients.first_name, ' ', clients.last_name) AS client_name, COUNT(leads.id) AS number_of_leads,
MONTHNAME(leads.registered_datetime) AS month_generated FROM clients
JOIN sites ON sites.client_id = clients.id
JOIN leads ON leads.site_id = sites.id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-6-30'
GROUP BY leads.id;


-- 8. What query would you run to get a list of client name and the total # of leads we've generated
-- for each of our client's sites between January 1st 2011 to December 31st  2011?
-- Come up with a second query that shows all the clients, the site name(s),
-- and the total number of leads generated from each site for all time.

SELECT GROUP_CONCAT(clients.first_name, ' ', clients.last_name) AS client_name, sites.domain_name,
COUNT(leads.id) AS number_of_leads FROM clients
JOIN sites ON sites.client_id = clients.id
JOIN leads ON leads.site_id = sites.id
WHERE leads.registered_datetime BETWEEN '2011-01-01' AND '2011-12-31'
GROUP BY sites.id
ORDER BY clients.id;

SELECT GROUP_CONCAT(clients.first_name, ' ', clients.last_name) AS client_name, sites.domain_name,
COUNT(leads.id) AS number_of_leads FROM clients
JOIN sites ON sites.client_id = clients.id
JOIN leads ON leads.site_id = sites.id
GROUP BY sites.id
ORDER BY clients.id;


-- 9. Write a single query that retrieves total revenue collected from each client each month of the year.

SELECT GROUP_CONCAT(clients.first_name, ' ', clients.last_name) AS client_name, 
SUM(billings.amount) as total_revenue, MONTHNAME(billings.charged_datetime) AS month_charge, 
YEAR(billings.charged_datetime) AS year_charge
FROM billings
JOIN clients ON clients.id = billings.client_id
GROUP BY billings.id
ORDER BY clients.id;


-- 10. Write a single query that retrieves all the sites that each client owns. 
-- Group the results so that each row shows a new client and have a new field called 'sites' 
-- that has all the sites that the client owns. (HINT: use GROUP_CONCAT)

SELECT GROUP_CONCAT(clients.first_name, ' ', clients.last_name) AS client_name, GROUP_CONCAT(' ', sites.domain_name) AS sites 
FROM clients
JOIN sites ON sites.client_id = clients.id
GROUP BY clients.id;