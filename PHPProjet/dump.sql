--
-- PostgreSQL database dump
--

-- Dumped from database version 10.5 (Ubuntu 10.5-0ubuntu0.18.04)
-- Dumped by pg_dump version 10.5 (Ubuntu 10.5-0ubuntu0.18.04)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: combatcoq; Type: TABLE; Schema: public; Owner: anthony
--

CREATE TABLE public.combatcoq (
    datecombat date NOT NULL,
    lieucombat character varying(25) NOT NULL,
    coq1 character varying(25) NOT NULL,
    coq2 character varying(25) NOT NULL
);


ALTER TABLE public.combatcoq OWNER TO anthony;

--
-- Name: coq; Type: TABLE; Schema: public; Owner: anthony
--

CREATE TABLE public.coq (
    nomcoq character varying(25) NOT NULL,
    nationalitecoq character varying(20),
    poids double precision NOT NULL,
    categoriecoq character varying(20) NOT NULL
);


ALTER TABLE public.coq OWNER TO anthony;

--
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: anthony
--

CREATE TABLE public.utilisateur (
    iduser integer NOT NULL,
    nomuser character varying(20) NOT NULL,
    prenomuser character varying(20) NOT NULL,
    mailuser character varying(50) NOT NULL,
    mdpuser character varying(64) NOT NULL,
    datenaissance date NOT NULL
);


ALTER TABLE public.utilisateur OWNER TO anthony;

--
-- Name: utilisateur_iduser_seq; Type: SEQUENCE; Schema: public; Owner: anthony
--

CREATE SEQUENCE public.utilisateur_iduser_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateur_iduser_seq OWNER TO anthony;

--
-- Name: utilisateur_iduser_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: anthony
--

ALTER SEQUENCE public.utilisateur_iduser_seq OWNED BY public.utilisateur.iduser;


--
-- Name: utilisateur iduser; Type: DEFAULT; Schema: public; Owner: anthony
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN iduser SET DEFAULT nextval('public.utilisateur_iduser_seq'::regclass);


--
-- Data for Name: combatcoq; Type: TABLE DATA; Schema: public; Owner: anthony
--

COPY public.combatcoq (datecombat, lieucombat, coq1, coq2) FROM stdin;
\.


--
-- Data for Name: coq; Type: TABLE DATA; Schema: public; Owner: anthony
--

COPY public.coq (nomcoq, nationalitecoq, poids, categoriecoq) FROM stdin;
La Machine	France	3	poids normal
Le Cogneur	Allemagne	4	poids normal
Le tueur	Français	7	poids lourd
La castagne	Français	1	poids leger
Lecoq Sportif	Français	5	poids lourd
Coq Tail	Français	6.5	poids lourd
Coq Licot	Français	2	poids leger
Test suppression	Français	152	poids lourd
\.


--
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: anthony
--

COPY public.utilisateur (iduser, nomuser, prenomuser, mailuser, mdpuser, datenaissance) FROM stdin;
30	Duquenoy	Anthony	duquenoy.anthony@outlook.com	c5385621881c09d1cf98758422aa55bd82ade3becbcafb079aa0a3d7c385e5b4	1999-01-22
31	Testeur	Compte	compte.testeur@mail.com	2f9b41cb15524d25550b14708d0f706fc01365135102d6e7f16756223f698a2c	0001-01-01
32	Compte	Admin	compte.admin@mail.com	3b612c75a7b5048a435fb6ec81e52ff92d6d795a8b5a9c17070f6a63c97a53b2	0001-01-01
\.


--
-- Name: utilisateur_iduser_seq; Type: SEQUENCE SET; Schema: public; Owner: anthony
--

SELECT pg_catalog.setval('public.utilisateur_iduser_seq', 32, true);


--
-- Name: combatcoq combatcoq_pkey; Type: CONSTRAINT; Schema: public; Owner: anthony
--

ALTER TABLE ONLY public.combatcoq
    ADD CONSTRAINT combatcoq_pkey PRIMARY KEY (datecombat, lieucombat);


--
-- Name: coq coq_pkey; Type: CONSTRAINT; Schema: public; Owner: anthony
--

ALTER TABLE ONLY public.coq
    ADD CONSTRAINT coq_pkey PRIMARY KEY (nomcoq);


--
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: anthony
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (iduser);


--
-- Name: combatcoq combatcoq_coq1_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anthony
--

ALTER TABLE ONLY public.combatcoq
    ADD CONSTRAINT combatcoq_coq1_fkey FOREIGN KEY (coq1) REFERENCES public.coq(nomcoq);


--
-- Name: combatcoq combatcoq_coq2_fkey; Type: FK CONSTRAINT; Schema: public; Owner: anthony
--

ALTER TABLE ONLY public.combatcoq
    ADD CONSTRAINT combatcoq_coq2_fkey FOREIGN KEY (coq2) REFERENCES public.coq(nomcoq);


--
-- PostgreSQL database dump complete
--

