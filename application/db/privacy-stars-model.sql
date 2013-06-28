CREATE TABLE privacy_stars
(
  star_id integer NOT NULL,
  star_short_name text,
  star_long_des text,
  star_long_des1 text,
  CONSTRAINT star_id_pkey PRIMARY KEY (star_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE privacy_stars
  OWNER TO ixmaps;
GRANT ALL ON TABLE privacy_stars TO ixmaps;


CREATE TABLE privacy_scores
(
  id serial NOT NULL,
  star_id integer NOT NULL,
  asn integer,
  carrier_name character varying(240),
  score double precision,
  created_by character varying(50),
  CONSTRAINT star_score_id_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE privacy_scores
  OWNER TO ixmaps;
GRANT ALL ON TABLE privacy_scores TO ixmaps;