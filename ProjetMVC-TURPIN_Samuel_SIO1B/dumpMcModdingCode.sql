--
-- PostgreSQL database dump
--

-- Dumped from database version 16.8
-- Dumped by pg_dump version 16.8

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: components; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.components (
    cno text NOT NULL,
    description text,
    code text,
    lno integer NOT NULL
);


ALTER TABLE public.components OWNER TO sturpin;

--
-- Name: loaders; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.loaders (
    lno integer NOT NULL,
    name character varying(50),
    icon character varying(50)
);


ALTER TABLE public.loaders OWNER TO sturpin;

--
-- Name: loadertuto; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.loadertuto (
    tno integer NOT NULL,
    lno integer NOT NULL
);


ALTER TABLE public.loadertuto OWNER TO sturpin;

--
-- Name: post; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.post (
    pno integer NOT NULL,
    title text,
    description text,
    version text,
    uno integer NOT NULL,
    lno integer NOT NULL
);


ALTER TABLE public.post OWNER TO sturpin;

--
-- Name: post_pno_seq; Type: SEQUENCE; Schema: public; Owner: sturpin
--

CREATE SEQUENCE public.post_pno_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_pno_seq OWNER TO sturpin;

--
-- Name: post_pno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sturpin
--

ALTER SEQUENCE public.post_pno_seq OWNED BY public.post.pno;


--
-- Name: reponse; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.reponse (
    rno integer NOT NULL,
    msg text,
    pno integer NOT NULL,
    uno integer NOT NULL
);


ALTER TABLE public.reponse OWNER TO sturpin;

--
-- Name: reponse_rno_seq; Type: SEQUENCE; Schema: public; Owner: sturpin
--

CREATE SEQUENCE public.reponse_rno_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reponse_rno_seq OWNER TO sturpin;

--
-- Name: reponse_rno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sturpin
--

ALTER SEQUENCE public.reponse_rno_seq OWNED BY public.reponse.rno;


--
-- Name: tutorials; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.tutorials (
    tno integer NOT NULL,
    title text,
    version character varying(50),
    about text,
    description text,
    finaldesc text
);


ALTER TABLE public.tutorials OWNER TO sturpin;

--
-- Name: tutorials_tno_seq; Type: SEQUENCE; Schema: public; Owner: sturpin
--

CREATE SEQUENCE public.tutorials_tno_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tutorials_tno_seq OWNER TO sturpin;

--
-- Name: tutorials_tno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sturpin
--

ALTER SEQUENCE public.tutorials_tno_seq OWNED BY public.tutorials.tno;


--
-- Name: users; Type: TABLE; Schema: public; Owner: sturpin
--

CREATE TABLE public.users (
    uno integer NOT NULL,
    name text NOT NULL,
    email text NOT NULL,
    password text,
    phone text
);


ALTER TABLE public.users OWNER TO sturpin;

--
-- Name: users_uno_seq; Type: SEQUENCE; Schema: public; Owner: sturpin
--

CREATE SEQUENCE public.users_uno_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_uno_seq OWNER TO sturpin;

--
-- Name: users_uno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sturpin
--

ALTER SEQUENCE public.users_uno_seq OWNED BY public.users.uno;


--
-- Name: post pno; Type: DEFAULT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.post ALTER COLUMN pno SET DEFAULT nextval('public.post_pno_seq'::regclass);


--
-- Name: reponse rno; Type: DEFAULT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.reponse ALTER COLUMN rno SET DEFAULT nextval('public.reponse_rno_seq'::regclass);


--
-- Name: tutorials tno; Type: DEFAULT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.tutorials ALTER COLUMN tno SET DEFAULT nextval('public.tutorials_tno_seq'::regclass);


--
-- Name: users uno; Type: DEFAULT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.users ALTER COLUMN uno SET DEFAULT nextval('public.users_uno_seq'::regclass);


--
-- Data for Name: components; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.components (cno, description, code, lno) FROM stdin;
imgbloc1	Bloc d'exemple rose posé dans un monde plat	textures/blockresult2.png	4
javabouf2	pizza	R2D2	1
javanourriture2	zdlzadk	dlzldkz	2
jsonnourriture1	ljiuhuyjgjyu	bjbjhbjkj	1
javabloc2	Voici une création de bloc basique (tutorial est l'id du mod et example_block et l'id du block)	public class ModBlocks {\r\n\r\n    //Create a new block\r\n    public static final Block EXAMPLE_BLOCK = new Block(AbstractBlock.Settings.create().hardness(4.0f).registryKey(RegistryKey.of(RegistryKeys.BLOCK, Identifier.of("tutorial", "example_block"))));\r\n\r\n    public static void initBlocks()\r\n    {\r\n        //Register the block\r\n        Registry.register(Registries.BLOCK, Identifier.of("tutorial", "example_block"), EXAMPLE_BLOCK);\r\n        Registry.register(Registries.ITEM, Identifier.of("tutorial", "example_block"), new BlockItem(EXAMPLE_BLOCK, new Item.Settings().useBlockPrefixedTranslationKey()\r\n                .registryKey(RegistryKey.of(RegistryKeys.ITEM, Identifier.of("tutorial", "example_block")))));\r\n    }\r\n}	2
javabloc1	La classe de base pour la création de bloc est <b>Block</b> qui possède un seul argument qu'on appelle Settings de la classe AbstractBlock !	//Création des Settings\r\n.create() //Necessaire dans la creation des paramètres\r\n.copy(AbstractBlock block) //Copie les paramètres d'un autre bloc (ex: .copy(Blocks.DIAMOND_BLOCK))\r\n\r\n//Après la création des Settings\r\n.strength(float hardness, float resistance)  //Pour la force du bloc, hardness le temps de casse pour le joueur et resistance pour la résistance au explosion par exemple\r\n.strength(float hardness) //Fait exactement la même chose que ci dessus mais ne necessite qu'un paramètre, la résistance et elle appliqué par défaut\r\n.requiresTool() //Le bloc doit être récupérer avec le bon outil (ex: Pioche pour la pierre)\r\n.sounds(BlockSoundGroup soundGroup) //Définis le son du bloc par défaut c'est celui de la roche\r\n.nonOpaque() //Définit le bloc comme transparent (La lumière passe à travers)\r\n.noCollision() //Définit que le bloc n'a pas de collision (utile pour les plantes)\r\n.breakInstantly() //Définit que le bloc se casse instant (ex: herbes ou torches)\r\n.dropsLike(Block source) //Définit un drop d'un autre bloc à la place (ex : torche mural drop une torche)\r\n.luminance(ToIntFunction<BlockState> luminance) //Définit la lumiére que le bloc emmet (ex: .luminance(state -> 15) pour la glowstone)	2
javabloc3	Ne pas oublier d'initialiser l'enregistrement dans la classe principal, pour l'ajouter à une table creative on utilise ItemGroupEvents	public class TutorialMod implements ModInitializer {\r\n\r\n    public static final String MOD_ID = "tutorial";\r\n\r\n    public void onInitialize()\r\n    {\r\n            ModBlocks.initBlocks();\r\n            ItemGroupEvents.modifyEntriesEvent(ItemGroups.BUILDING_BLOCKS).register(content -> {\r\n                content.add(ModBlocks.EXAMPLE_BLOCK);\r\n            });\r\n    }\r\n}	2
imgnourriture2	kzlzldlzd	dlzlkdlzd,	1
jsonbloc1	voici un language	fr_fr.json	4
javaxxx1	dsdsdss	blablbla java	4
\.


--
-- Data for Name: loaders; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.loaders (lno, name, icon) FROM stdin;
1	forge	logo_forge
2	fabric	logo_fabric
3	neoforge	logo_neoforge
4	minecraft	logo_minecraft
\.


--
-- Data for Name: loadertuto; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.loadertuto (tno, lno) FROM stdin;
\.


--
-- Data for Name: post; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.post (pno, title, description, version, uno, lno) FROM stdin;
11	szdz	dzdd	11	1	1
12	elpzkdùp	dpzdkpz	1.21.4	1	3
18	Information Utile	Si tu tapes sur ton clavier, des lettres s’affichent à l’écran ! Ne me remerciez pas 😎	99.023	18	4
\.


--
-- Data for Name: reponse; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.reponse (rno, msg, pno, uno) FROM stdin;
3	pkezj,e	12	1
6	coucou pour ton pb de nourriture recherche dans la doc	11	1
7	BBB	11	16
8	dkzpdkzkdf,	12	16
9	;aml;sm	11	1
10	Fake News	18	1
11	eee	11	1
\.


--
-- Data for Name: tutorials; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.tutorials (tno, title, version, about, description, finaldesc) FROM stdin;
4	Bouf	1.21.4	La bouf	La bouf c'est bien	Voici une pomme verte
5	Bloc	1.21.4	Créer un bloc basic	Les blocs sont la base de Minecraft, dans ce tutoriel nous allons voir comment créer un bloc avec 	Cela nous donne un bloc tout rose
6	Nourriture Enchant	1.21.4	La bouf enchant	c'est super	voici une bouf enchant qui brille
7	xxx	2	,j	,k	l;mlm
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: sturpin
--

COPY public.users (uno, name, email, password, phone) FROM stdin;
15	A	aaa@mail.com	$2y$10$2v4GhttUS9LW0HYKA7p2IeRGUCExYz9AywqXtlyJYNDU6BSiRd362	A
1	Admin	admin@mail.com	$2y$10$pzJsRFZpykhHctQQszpTLOutxp1D.Lpox.COkzzvqZhlBNOrf/XLO	007
16	B	b@mail.cpm	$2y$10$EFA1Y6rxJwD6Dnj23NqiGOlPw9s2vsCUerSxDAPLVgs2FxobuzhTi	b
17	AAAA	turpin.saa@gmail.com	$2y$10$j86tLVEZOiTtPGGNQqAzrOuv5W.EwDgbLFzkLSHryohGLTpenSwCG	444
18	UnOrdinary	unordinary@yopmail.com	$2y$10$hDRxNOubxt6Arpb0d5uEauADMpLE8326mewb.mMwFjkJvTx0nICsq	0123456789
\.


--
-- Name: post_pno_seq; Type: SEQUENCE SET; Schema: public; Owner: sturpin
--

SELECT pg_catalog.setval('public.post_pno_seq', 18, true);


--
-- Name: reponse_rno_seq; Type: SEQUENCE SET; Schema: public; Owner: sturpin
--

SELECT pg_catalog.setval('public.reponse_rno_seq', 11, true);


--
-- Name: tutorials_tno_seq; Type: SEQUENCE SET; Schema: public; Owner: sturpin
--

SELECT pg_catalog.setval('public.tutorials_tno_seq', 8, true);


--
-- Name: users_uno_seq; Type: SEQUENCE SET; Schema: public; Owner: sturpin
--

SELECT pg_catalog.setval('public.users_uno_seq', 18, true);


--
-- Name: components components_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.components
    ADD CONSTRAINT components_pkey PRIMARY KEY (cno, lno);


--
-- Name: loaders loaders_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.loaders
    ADD CONSTRAINT loaders_pkey PRIMARY KEY (lno);


--
-- Name: loadertuto loadertuto_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.loadertuto
    ADD CONSTRAINT loadertuto_pkey PRIMARY KEY (tno, lno);


--
-- Name: post post_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.post
    ADD CONSTRAINT post_pkey PRIMARY KEY (pno);


--
-- Name: reponse reponse_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.reponse
    ADD CONSTRAINT reponse_pkey PRIMARY KEY (rno, pno);


--
-- Name: tutorials tutorials_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.tutorials
    ADD CONSTRAINT tutorials_pkey PRIMARY KEY (tno);


--
-- Name: users unique_user_email; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT unique_user_email UNIQUE (email);


--
-- Name: users unique_user_name; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT unique_user_name UNIQUE (name);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (uno);


--
-- Name: components components_lno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.components
    ADD CONSTRAINT components_lno_fkey FOREIGN KEY (lno) REFERENCES public.loaders(lno);


--
-- Name: loadertuto loadertuto_lno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.loadertuto
    ADD CONSTRAINT loadertuto_lno_fkey FOREIGN KEY (lno) REFERENCES public.loaders(lno);


--
-- Name: loadertuto loadertuto_tno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.loadertuto
    ADD CONSTRAINT loadertuto_tno_fkey FOREIGN KEY (tno) REFERENCES public.tutorials(tno);


--
-- Name: post post_lno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.post
    ADD CONSTRAINT post_lno_fkey FOREIGN KEY (lno) REFERENCES public.loaders(lno);


--
-- Name: post post_uno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.post
    ADD CONSTRAINT post_uno_fkey FOREIGN KEY (uno) REFERENCES public.users(uno);


--
-- Name: reponse reponse_pno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.reponse
    ADD CONSTRAINT reponse_pno_fkey FOREIGN KEY (pno) REFERENCES public.post(pno);


--
-- Name: reponse reponse_uno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: sturpin
--

ALTER TABLE ONLY public.reponse
    ADD CONSTRAINT reponse_uno_fkey FOREIGN KEY (uno) REFERENCES public.users(uno);


--
-- PostgreSQL database dump complete
--

