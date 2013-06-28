CREATE TABLE ip_flagged_items
(
  id_f SERIAL PRIMARY KEY, -- unique id
  ip_addr_f inet, -- ip address being flagged
  date_f timestamp with time zone NOT NULL, -- Time of submission of the completed traceroute
  user_ip inet, -- user ip address
  user_nick character varying(50), -- user nick name (optional)
  user_reasons_types character varying(100), -- ids of the possible reasons of error in geolocation
  user_msg text, -- user explanation
  ip_new_loc text -- new location suggested by user
)
WITH (
  OIDS=FALSE
);
ALTER TABLE ip_flagged_items
  OWNER TO ixmaps;
GRANT ALL ON TABLE ip_flagged_items TO ixmaps;

ALTER TABLE ip_addr_info ADD COLUMN flagged int DEFAULT 0;