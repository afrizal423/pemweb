--
-- PostgreSQL database dump
--

-- Dumped from database version 11.3
-- Dumped by pg_dump version 11.3

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

--
-- Name: meminjam_buku(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.meminjam_buku() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
		update buku
		set jumlah_buku_tersedia = jumlah_buku_tersedia-1
		where id_buku = NEW.id_buku;
 
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.meminjam_buku() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: anggota; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.anggota (
    id_anggota character varying(10) NOT NULL,
    id_mhs character varying(11),
    alamat_anggota character varying(30) NOT NULL,
    notlp_anggota character varying(15) NOT NULL
);


ALTER TABLE public.anggota OWNER TO postgres;

--
-- Name: buku; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.buku (
    id_buku character varying(10) NOT NULL,
    id_kategori character varying(10) NOT NULL,
    kode_rak character varying(10) NOT NULL,
    judulbuku character varying(30),
    pengarang character varying(30),
    penerbit character varying(30),
    isbn character varying(25),
    jumlah_buku_tersedia integer
);


ALTER TABLE public.buku OWNER TO postgres;

--
-- Name: detail_peminjaman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.detail_peminjaman (
    id_detail character varying(10) NOT NULL,
    id_anggota character varying(10),
    id_pegawai character varying(10),
    tglpinjam date,
    tglkembali date,
    denda integer,
    ket_buku character varying(25)
);


ALTER TABLE public.detail_peminjaman OWNER TO postgres;

--
-- Name: kategori; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.kategori (
    id_kategori character varying(10) NOT NULL,
    namakategori character varying(30)
);


ALTER TABLE public.kategori OWNER TO postgres;

--
-- Name: mahasiswa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mahasiswa (
    id_mhs character varying(11) NOT NULL,
    nama_mhs character varying(200),
    npm_mhs character varying(13),
    jurusan character varying(1024),
    fakultas character varying(1024)
);


ALTER TABLE public.mahasiswa OWNER TO postgres;

--
-- Name: pegawai; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pegawai (
    id_pegawai character varying(10) NOT NULL,
    nama_pegawai character varying(30) NOT NULL,
    nip_pegawai character varying(20),
    alamat_pegawai character varying(30),
    notlp_pegawai character varying(15)
);


ALTER TABLE public.pegawai OWNER TO postgres;

--
-- Name: peminjaman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.peminjaman (
    id_peminjaman character varying(10) NOT NULL,
    id_detail character varying(10),
    id_buku character varying(10) NOT NULL,
    waktu date NOT NULL
);


ALTER TABLE public.peminjaman OWNER TO postgres;

--
-- Name: rak_buku; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rak_buku (
    kode_rak character varying(10) NOT NULL,
    namarak character varying(30)
);


ALTER TABLE public.rak_buku OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    user_name character varying(15) NOT NULL,
    user_email character varying(40) NOT NULL,
    user_pass character varying(255) NOT NULL,
    id_pegawai character varying(2) NOT NULL,
    joining_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Data for Name: anggota; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.anggota (id_anggota, id_mhs, alamat_anggota, notlp_anggota) FROM stdin;
VcW3SD5Rpf	9bgpxctU8VT	sby	12
6uv7DmRc52	AvhL7ciZ9q4	sby	12
h7M2BFcdtS	xacGngWEK2d	sby	12
6hbd8tYf9A	CFESdsomzZO	sby	12
\.


--
-- Data for Name: buku; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.buku (id_buku, id_kategori, kode_rak, judulbuku, pengarang, penerbit, isbn, jumlah_buku_tersedia) FROM stdin;
H2ZYtfDAMO	G0CfsdnX8V	lbCEkYfeDy	C++	Afrizal	n	j	10
iTrR8Y6qZP	G0CfsdnX8V	Ufl8uFTgcd	IPv6	AfRizal	n	j	9
gaAlt4z1j2	G0CfsdnX8V	lbCEkYfeDy	Ruby	AfRizal	n	j	10
R83LixdCvo	jKJtH51hYz	Ufl8uFTgcd	PHP	Afrizal	n	j	9
1DxTwXzi8Q	mhk8DFMw1a	lbCEkYfeDy	Malin Kundang	AfRizal	n	j	8
i9ocXxj1n8	G0CfsdnX8V	by639WpgsF	Python	Afrizal	n	j	9
\.


--
-- Data for Name: detail_peminjaman; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.detail_peminjaman (id_detail, id_anggota, id_pegawai, tglpinjam, tglkembali, denda, ket_buku) FROM stdin;
6LFQ01YZNK	h7M2BFcdtS	1	2019-12-10	\N	\N	\N
\.


--
-- Data for Name: kategori; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.kategori (id_kategori, namakategori) FROM stdin;
G0CfsdnX8V	Teknologi
jKJtH51hYz	Cerpen
mhk8DFMw1a	Dongeng
\.


--
-- Data for Name: mahasiswa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mahasiswa (id_mhs, nama_mhs, npm_mhs, jurusan, fakultas) FROM stdin;
9bgpxctU8VT	Afrizal Muhammad Yasin, Surya Adi laksono	12	Teknik Informatika	fik
AvhL7ciZ9q4	Afrizal Muhammad Yasin, Surya Adi laksono	13	Teknik Informatika	fik
xacGngWEK2d	Afrizal Muhammad Yasin	17081010092	Teknik Informatika	fik
CFESdsomzZO	Surya Adi laksono	17081010102	Teknik Informatika	fik
\.


--
-- Data for Name: pegawai; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pegawai (id_pegawai, nama_pegawai, nip_pegawai, alamat_pegawai, notlp_pegawai) FROM stdin;
1	Afrizal Muhammad Yasin	17081010092	Surabaya	14045
\.


--
-- Data for Name: peminjaman; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.peminjaman (id_peminjaman, id_detail, id_buku, waktu) FROM stdin;
P3O6LUIsne	6LFQ01YZNK	i9ocXxj1n8	2019-12-10
\.


--
-- Data for Name: rak_buku; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rak_buku (kode_rak, namarak) FROM stdin;
lbCEkYfeDy	Lantai Dasar C102
by639WpgsF	Lantai Dasar C103
Ufl8uFTgcd	Lantai Dasar C101
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (user_id, user_name, user_email, user_pass, id_pegawai, joining_date) FROM stdin;
1	afrizal	afrizal2499@gmail.com	$2y$10$gmkglVOshaZDV7Zzp0mUDul0TtPQ90EYBBQyMeGAp2c3pjl7.CT9u	1	2019-09-21 10:49:49.745351
\.


--
-- Name: anggota pk_anggota; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anggota
    ADD CONSTRAINT pk_anggota PRIMARY KEY (id_anggota);


--
-- Name: buku pk_buku; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.buku
    ADD CONSTRAINT pk_buku PRIMARY KEY (id_buku);


--
-- Name: detail_peminjaman pk_detail_peminjaman; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_peminjaman
    ADD CONSTRAINT pk_detail_peminjaman PRIMARY KEY (id_detail);


--
-- Name: kategori pk_kategori; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.kategori
    ADD CONSTRAINT pk_kategori PRIMARY KEY (id_kategori);


--
-- Name: mahasiswa pk_mahasiswa; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mahasiswa
    ADD CONSTRAINT pk_mahasiswa PRIMARY KEY (id_mhs);


--
-- Name: pegawai pk_pegawai; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pegawai
    ADD CONSTRAINT pk_pegawai PRIMARY KEY (id_pegawai);


--
-- Name: peminjaman pk_peminjaman; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman
    ADD CONSTRAINT pk_peminjaman PRIMARY KEY (id_peminjaman);


--
-- Name: rak_buku pk_rak_buku; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rak_buku
    ADD CONSTRAINT pk_rak_buku PRIMARY KEY (kode_rak);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: anggota_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX anggota_pk ON public.anggota USING btree (id_anggota);


--
-- Name: buku_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX buku_pk ON public.buku USING btree (id_buku);


--
-- Name: detail_peminjaman_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX detail_peminjaman_pk ON public.detail_peminjaman USING btree (id_detail);


--
-- Name: dipinjam_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX dipinjam_fk ON public.peminjaman USING btree (id_buku);


--
-- Name: disimpan_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX disimpan_fk ON public.buku USING btree (kode_rak);


--
-- Name: kategori_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX kategori_pk ON public.kategori USING btree (id_kategori);


--
-- Name: mahasiswa_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX mahasiswa_pk ON public.mahasiswa USING btree (id_mhs);


--
-- Name: pegawai_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX pegawai_pk ON public.pegawai USING btree (id_pegawai);


--
-- Name: peminjaman_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX peminjaman_pk ON public.peminjaman USING btree (id_peminjaman);


--
-- Name: rak_buku_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX rak_buku_pk ON public.rak_buku USING btree (kode_rak);


--
-- Name: relationship_11_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_11_fk ON public.peminjaman USING btree (id_detail);


--
-- Name: relationship_12_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_12_fk ON public.detail_peminjaman USING btree (id_anggota);


--
-- Name: relationship_15_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_15_fk ON public.detail_peminjaman USING btree (id_pegawai);


--
-- Name: relationship_4_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_4_fk ON public.buku USING btree (id_kategori);


--
-- Name: relationship_8_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX relationship_8_fk ON public.anggota USING btree (id_mhs);


--
-- Name: peminjaman pinjambuku; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER pinjambuku AFTER INSERT ON public.peminjaman FOR EACH ROW EXECUTE PROCEDURE public.meminjam_buku();


--
-- Name: anggota fk_anggota_relations_mahasisw; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anggota
    ADD CONSTRAINT fk_anggota_relations_mahasisw FOREIGN KEY (id_mhs) REFERENCES public.mahasiswa(id_mhs) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: buku fk_buku_disimpan_rak_buku; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.buku
    ADD CONSTRAINT fk_buku_disimpan_rak_buku FOREIGN KEY (kode_rak) REFERENCES public.rak_buku(kode_rak) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: buku fk_buku_relations_kategori; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.buku
    ADD CONSTRAINT fk_buku_relations_kategori FOREIGN KEY (id_kategori) REFERENCES public.kategori(id_kategori) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: detail_peminjaman fk_detail_p_relations_anggota; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_peminjaman
    ADD CONSTRAINT fk_detail_p_relations_anggota FOREIGN KEY (id_anggota) REFERENCES public.anggota(id_anggota) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: detail_peminjaman fk_detail_p_relations_pegawai; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.detail_peminjaman
    ADD CONSTRAINT fk_detail_p_relations_pegawai FOREIGN KEY (id_pegawai) REFERENCES public.pegawai(id_pegawai) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: peminjaman fk_peminjam_dipinjam_buku; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman
    ADD CONSTRAINT fk_peminjam_dipinjam_buku FOREIGN KEY (id_buku) REFERENCES public.buku(id_buku) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: peminjaman fk_peminjam_relations_detail_p; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman
    ADD CONSTRAINT fk_peminjam_relations_detail_p FOREIGN KEY (id_detail) REFERENCES public.detail_peminjaman(id_detail) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

