--
-- PostgreSQL database dump
--

\restrict s8x4X9JyWYHkXWVQgSMZIewovky6Z6xnwRs2C3S6RabdOjl7nnTiiVnzdAJUs4L

-- Dumped from database version 16.13 (Ubuntu 16.13-0ubuntu0.24.04.1)
-- Dumped by pg_dump version 16.13 (Ubuntu 16.13-0ubuntu0.24.04.1)

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
-- Name: bouquet_flowers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bouquet_flowers (
    id bigint NOT NULL,
    bouquet_id bigint NOT NULL,
    flower_id bigint NOT NULL,
    quantity integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: bouquet_flowers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bouquet_flowers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bouquet_flowers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bouquet_flowers_id_seq OWNED BY public.bouquet_flowers.id;


--
-- Name: bouquets; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bouquets (
    id bigint NOT NULL,
    category_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    price numeric(8,2) NOT NULL,
    image character varying(255),
    is_available boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: bouquets_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bouquets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bouquets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bouquets_id_seq OWNED BY public.bouquets.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration bigint NOT NULL
);


--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration bigint NOT NULL
);


--
-- Name: categories; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    description text,
    image character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: flowers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.flowers (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    color character varying(255),
    price numeric(8,2) NOT NULL,
    stock integer DEFAULT 0 NOT NULL,
    image character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: flowers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.flowers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: flowers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.flowers_id_seq OWNED BY public.flowers.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: order_items; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.order_items (
    id bigint NOT NULL,
    order_id bigint NOT NULL,
    bouquet_id bigint,
    bouquet_name character varying(255) NOT NULL,
    quantity integer NOT NULL,
    price numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: order_items_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.order_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: order_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.order_items_id_seq OWNED BY public.order_items.id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.orders (
    id bigint NOT NULL,
    user_id bigint,
    customer_name character varying(255) NOT NULL,
    customer_phone character varying(255) NOT NULL,
    delivery_address character varying(255) NOT NULL,
    delivery_time timestamp(0) without time zone NOT NULL,
    total_amount numeric(10,2) DEFAULT '0'::numeric NOT NULL,
    status character varying(255) DEFAULT 'new'::character varying NOT NULL,
    comment text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT orders_status_check CHECK (((status)::text = ANY ((ARRAY['new'::character varying, 'confirmed'::character varying, 'delivering'::character varying, 'delivered'::character varying, 'cancelled'::character varying])::text[])))
);


--
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: bouquet_flowers id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquet_flowers ALTER COLUMN id SET DEFAULT nextval('public.bouquet_flowers_id_seq'::regclass);


--
-- Name: bouquets id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquets ALTER COLUMN id SET DEFAULT nextval('public.bouquets_id_seq'::regclass);


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: flowers id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flowers ALTER COLUMN id SET DEFAULT nextval('public.flowers_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: order_items id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.order_items ALTER COLUMN id SET DEFAULT nextval('public.order_items_id_seq'::regclass);


--
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: bouquet_flowers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.bouquet_flowers (id, bouquet_id, flower_id, quantity, created_at, updated_at) FROM stdin;
1	1	1	25	2026-05-03 12:54:37	2026-05-03 12:54:37
2	2	2	51	2026-05-03 12:54:37	2026-05-03 12:54:37
3	3	3	20	2026-05-03 12:54:37	2026-05-03 12:54:37
4	3	2	10	2026-05-03 12:54:37	2026-05-03 12:54:37
5	4	5	17	2026-05-03 12:54:37	2026-05-03 12:54:37
6	4	6	17	2026-05-03 12:54:37	2026-05-03 12:54:37
7	4	7	17	2026-05-03 12:54:37	2026-05-03 12:54:37
8	5	6	25	2026-05-03 12:54:37	2026-05-03 12:54:37
9	5	8	26	2026-05-03 12:54:37	2026-05-03 12:54:37
10	6	9	15	2026-05-03 12:54:37	2026-05-03 12:54:37
11	7	10	15	2026-05-03 12:54:37	2026-05-03 12:54:37
12	8	1	10	2026-05-03 12:54:37	2026-05-03 12:54:37
13	8	5	10	2026-05-03 12:54:37	2026-05-03 12:54:37
14	8	11	10	2026-05-03 12:54:37	2026-05-03 12:54:37
15	9	14	15	2026-05-03 12:54:37	2026-05-03 12:54:37
16	9	15	10	2026-05-03 12:54:37	2026-05-03 12:54:37
17	9	18	10	2026-05-03 12:54:37	2026-05-03 12:54:37
18	10	1	10	2026-05-03 12:54:37	2026-05-03 12:54:37
19	10	5	10	2026-05-03 12:54:37	2026-05-03 12:54:37
20	10	11	10	2026-05-03 12:54:37	2026-05-03 12:54:37
21	11	2	20	2026-05-03 12:54:37	2026-05-03 12:54:37
22	11	10	10	2026-05-03 12:54:37	2026-05-03 12:54:37
23	12	9	15	2026-05-03 12:54:37	2026-05-03 12:54:37
24	12	19	10	2026-05-03 12:54:37	2026-05-03 12:54:37
\.


--
-- Data for Name: bouquets; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.bouquets (id, category_id, name, description, price, image, is_available, created_at, updated_at) FROM stdin;
1	1	25 красных роз	Классический букет из 25 красных роз — символ любви и страсти.	3750.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
2	1	51 белая роза	Роскошный букет из 51 белоснежной розы для особых случаев.	7650.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
3	1	Розовый рай	Нежный букет из розовых и белых роз с зеленью.	4500.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
4	2	51 тюльпан	Весенний букет из 51 разноцветного тюльпана.	4080.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
5	2	Весенняя нежность	Смесь белых и розовых тюльпанов — идеально для 8 марта.	2550.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
6	3	Пионовый бум	Пышный букет из 15 розовых пионов.	3000.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
7	3	Белые пионы	Элегантный букет из белых пионов для свадьбы или юбилея.	3200.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
8	4	Летний микс	Яркий сборный букет из сезонных цветов.	2800.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
9	4	Полевые цветы	Ромашки, подсолнухи и нарциссы — букет как с луга.	1800.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
10	4	Радуга	Разноцветный букет из роз, тюльпанов и хризантем.	3200.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
11	5	Свадебный классик	Белые розы и пионы — идеальный свадебный букет.	5500.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
12	5	Нежная невеста	Розовые пионы и белые фрезии для незабываемого дня.	6000.00	\N	t	2026-05-03 12:54:37	2026-05-03 12:54:37
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.categories (id, name, slug, description, image, created_at, updated_at) FROM stdin;
1	Розы	rozy	Классические букеты из роз	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
2	Тюльпаны	tyulpany	Нежные весенние тюльпаны	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
3	Пионы	piony	Роскошные пионы	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
4	Смешанные	smeshannye	Сборные букеты	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
5	Свадебные	svadebnye	Букеты для свадьбы	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: flowers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.flowers (id, name, color, price, stock, image, created_at, updated_at) FROM stdin;
1	Роза красная	Красный	150.00	100	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
2	Роза белая	Белый	150.00	80	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
3	Роза розовая	Розовый	150.00	90	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
4	Роза жёлтая	Жёлтый	140.00	70	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
5	Тюльпан красный	Красный	80.00	120	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
6	Тюльпан белый	Белый	80.00	100	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
7	Тюльпан жёлтый	Жёлтый	80.00	90	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
8	Тюльпан розовый	Розовый	85.00	110	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
9	Пион розовый	Розовый	200.00	50	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
10	Пион белый	Белый	200.00	40	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
11	Хризантема	Белый	90.00	80	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
12	Лилия белая	Белый	120.00	60	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
13	Лилия розовая	Розовый	120.00	55	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
14	Ромашка	Белый	50.00	150	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
15	Подсолнух	Жёлтый	100.00	70	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
16	Гвоздика	Красный	60.00	120	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
17	Ирис	Фиолетовый	90.00	65	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
18	Нарцисс	Жёлтый	70.00	90	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
19	Фрезия	Розовый	110.00	75	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
20	Альстромерия	Оранжевый	85.00	85	\N	2026-05-03 12:54:37	2026-05-03 12:54:37
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
7	2026_05_03_084032_create_categories_table	2
8	2026_05_03_084032_create_flowers_table	2
9	2026_05_03_084033_create_bouquets_table	2
10	2026_05_03_084033_create_orders_table	2
11	2026_05_03_084036_create_order_items_table	2
12	2026_05_03_084037_create_bouquet_flowers_table	2
\.


--
-- Data for Name: order_items; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.order_items (id, order_id, bouquet_id, bouquet_name, quantity, price, created_at, updated_at) FROM stdin;
1	1	2	51 белая роза	1	7650.00	2026-05-03 13:36:52	2026-05-03 13:36:52
2	2	2	51 белая роза	1	7650.00	2026-05-03 17:59:08	2026-05-03 17:59:08
3	4	\N	Свой букет: Роза белая x1, Роза розовая x1, Роза жёлтая x1, Тюльпан красный x1, Тюльпан жёлтый x1, Тюльпан розовый x1	1	685.00	2026-05-03 18:00:40	2026-05-03 18:00:40
4	5	\N	Свой букет: Роза розовая x1, Тюльпан красный x1, Тюльпан белый x1	1	310.00	2026-05-03 18:03:12	2026-05-03 18:03:12
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.orders (id, user_id, customer_name, customer_phone, delivery_address, delivery_time, total_amount, status, comment, created_at, updated_at) FROM stdin;
1	1	Михаил Мамонов	+7999999999	Люберцы 3я Понтовская	2026-11-11 13:13:00	7650.00	new	dwa	2026-05-03 13:36:52	2026-05-03 13:41:01
2	1	Михаил Мамонов	+7999999999	Люберцы 3я Понтовская	2026-12-12 12:12:00	7650.00	new	ВЦФЦвфц	2026-05-03 17:59:08	2026-05-03 17:59:08
4	1	Михаил Мамонов	+7999999999	Люберцы 3я Понтовская	2026-12-12 12:12:00	685.00	new	цвффцв	2026-05-03 18:00:40	2026-05-03 18:00:40
5	1	Михаил Мамонов	+7999999999	Люберцы 3я Понтовская	2026-12-12 12:12:00	310.00	new	wdadaw	2026-05-03 18:03:12	2026-05-03 18:03:12
6	1	Михаил Мамонов	+7999999999	Люберцы 3я Понтовская	2026-12-12 12:12:00	0.00	new	вфц	2026-05-03 18:25:17	2026-05-03 18:25:17
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
QV12VuCOeFBUTFAZ3lj8DdsLByKJQNt9ahhyl1j7	1	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 OPR/130.0.0.0 (Edition Yx GX)	eyJfdG9rZW4iOiJIdktkeW5sZDhUWUJHTnpFOXplQ3E1TzNSSnZ4N29UV05qQmNWdXZDIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3Byb2ZpbGUiLCJyb3V0ZSI6InByb2ZpbGUifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsImNhcnQiOltdfQ==	1777833503
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
1	mmi	mikh15001@gmail.com	\N	$2y$12$yLeZfnzrAL54TwebUO82AOguCOW/8MCSBA/kgAZQ4mpbCt.Tr3nTO	\N	2026-05-03 13:12:02	2026-05-03 13:12:02
\.


--
-- Name: bouquet_flowers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.bouquet_flowers_id_seq', 24, true);


--
-- Name: bouquets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.bouquets_id_seq', 12, true);


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categories_id_seq', 5, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: flowers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.flowers_id_seq', 20, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 12, true);


--
-- Name: order_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.order_items_id_seq', 4, true);


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.orders_id_seq', 6, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: bouquet_flowers bouquet_flowers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquet_flowers
    ADD CONSTRAINT bouquet_flowers_pkey PRIMARY KEY (id);


--
-- Name: bouquets bouquets_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquets
    ADD CONSTRAINT bouquets_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: categories categories_slug_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_slug_unique UNIQUE (slug);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: flowers flowers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.flowers
    ADD CONSTRAINT flowers_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: order_items order_items_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (id);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: bouquet_flowers bouquet_flowers_bouquet_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquet_flowers
    ADD CONSTRAINT bouquet_flowers_bouquet_id_foreign FOREIGN KEY (bouquet_id) REFERENCES public.bouquets(id) ON DELETE CASCADE;


--
-- Name: bouquet_flowers bouquet_flowers_flower_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquet_flowers
    ADD CONSTRAINT bouquet_flowers_flower_id_foreign FOREIGN KEY (flower_id) REFERENCES public.flowers(id) ON DELETE CASCADE;


--
-- Name: bouquets bouquets_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bouquets
    ADD CONSTRAINT bouquets_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: order_items order_items_bouquet_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_bouquet_id_foreign FOREIGN KEY (bouquet_id) REFERENCES public.bouquets(id) ON DELETE SET NULL;


--
-- Name: order_items order_items_order_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_order_id_foreign FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE CASCADE;


--
-- Name: orders orders_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

\unrestrict s8x4X9JyWYHkXWVQgSMZIewovky6Z6xnwRs2C3S6RabdOjl7nnTiiVnzdAJUs4L

