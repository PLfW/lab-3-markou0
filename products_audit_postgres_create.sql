CREATE TYPE user_permissions AS ENUM ('USER', 'ADMIN');

CREATE TABLE "user"(
  id serial NOT NULL,
  first_name character varying(30) NOT NULL,
  last_name character varying(30) NOT NULL,
  password character varying(30) NOT NULL,
  email character varying(40) NOT NULL,
  permissions user_permissions NOT NULL DEFAULT 'USER'::user_permissions,
  created_at timestamp with time zone NOT NULL DEFAULT now(),
  updated_at timestamp with time zone NOT NULL DEFAULT now(),
  CONSTRAINT user_pkey PRIMARY KEY (id),
  CONSTRAINT user_contact_phone_key UNIQUE (contact_phone),
  CONSTRAINT user_email_key UNIQUE (email),
  CONSTRAINT user_contact_phone_check CHECK (char_length(contact_phone::text) = 13),
  CONSTRAINT user_email_check CHECK (char_length(email::text) >= 6),
  CONSTRAINT user_password_check CHECK (char_length(password::text) >= 6)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user"
  OWNER TO postgres;

CREATE TABLE product (
	id serial NOT NULL,
	name varchar NOT NULL,
	description TEXT,
	date_created DATE DEFAULT current_date,
	price FLOAT,
	amount integer NOT NULL,
	location_id integer,
	user_id integer NOT NULL,
	qr_code TEXT,
	inventarisation_code varchar NOT NULL,
	product_type_id integer NOT NULL,
	CONSTRAINT product_pk PRIMARY KEY (id)
) WITH (
  OIDS=FALSE
);



CREATE TABLE product_property (
	id serial NOT NULL,
	product_id integer NOT NULL,
	name varchar NOT NULL,
	value varchar NOT NULL,
	CONSTRAINT product_property_pk PRIMARY KEY (id)
) WITH (
  OIDS=FALSE
);



CREATE TABLE product_type (
	id serial NOT NULL,
	name varchar NOT NULL,
	CONSTRAINT product_type_pk PRIMARY KEY (id)
) WITH (
  OIDS=FALSE
);



CREATE TABLE location (
	id serial NOT NULL,
	name varchar,
	room_no varchar,
	location_type_id integer NOT NULL,
	CONSTRAINT location_pk PRIMARY KEY (id)
) WITH (
  OIDS=FALSE
);


CREATE TABLE location_type (
	id serial NOT NULL,
	name varchar NOT NULL,
	CONSTRAINT location_type_pk PRIMARY KEY (id)
) WITH (
  OIDS=FALSE
);


ALTER TABLE product ADD CONSTRAINT product_fk0 FOREIGN KEY (location_id) REFERENCES location(id);
ALTER TABLE product ADD CONSTRAINT product_fk1 FOREIGN KEY (user_id) REFERENCES "user"(id) ;
ALTER TABLE product ADD CONSTRAINT product_fk2 FOREIGN KEY (product_type_id) REFERENCES product_type(id);
ALTER TABLE product_property ADD CONSTRAINT product_property_fk0 FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE;
ALTER TABLE location ADD CONSTRAINT location_fk0 FOREIGN KEY (location_type_id) REFERENCES location_type(id);