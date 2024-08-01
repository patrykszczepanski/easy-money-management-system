-- Create the user and grant privileges
CREATE USER emms_user WITH ENCRYPTED PASSWORD 'postgres';
ALTER ROLE emms_user SET client_encoding TO 'utf8';
ALTER ROLE emms_user SET default_transaction_isolation TO 'read committed';
ALTER ROLE emms_user SET timezone TO 'UTC';

-- Create the databases
CREATE DATABASE emms_db;
CREATE DATABASE emms_db_test;

-- Grant privileges on the databases to the user
GRANT ALL PRIVILEGES ON DATABASE emms_db TO emms_user;
GRANT ALL PRIVILEGES ON DATABASE emms_db_test TO emms_user;

-- emms_db formulas
\c emms_db;
CREATE SCHEMA IF NOT EXISTS public;
GRANT USAGE, CREATE ON SCHEMA public TO emms_user;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO emms_user;
GRANT EXECUTE ON ALL FUNCTIONS IN SCHEMA public TO emms_user;

-- emms_db_test formulas
\c emms_db_test;
GRANT USAGE, CREATE ON SCHEMA public TO emms_user;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO emms_user;
GRANT EXECUTE ON ALL FUNCTIONS IN SCHEMA public TO emms_user;