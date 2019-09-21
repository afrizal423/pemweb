/*==============================================================*/
/* DBMS name:      PostgreSQL 9.x                               */
/* Created on:     9/21/2019 9:46:34 AM                         */
/*==============================================================*/


drop index RELATIONSHIP_8_FK;

drop index ANGGOTA_PK;

drop table anggota;

drop index DISIMPAN_FK;

drop index RELATIONSHIP_4_FK;

drop index BUKU_PK;

drop table buku;

drop index RELATIONSHIP_15_FK;

drop index RELATIONSHIP_12_FK;

drop index DETAIL_PEMINJAMAN_PK;

drop table detail_peminjaman;

drop index KATEGORI_PK;

drop table kategori;

drop index MAHASISWA_PK;

drop table mahasiswa;

drop index PEGAWAI_PK;

drop table pegawai;

drop index RELATIONSHIP_11_FK;

drop index DIPINJAM_FK;

drop index PEMINJAMAN_PK;

drop table peminjaman;

drop index RAK_BUKU_PK;

drop table rak_buku;

/*==============================================================*/
/* Table: anggota                                               */
/*==============================================================*/
create table anggota (
   id_anggota           VARCHAR(10)          not null,
   id_mhs               VARCHAR(11)          null,
   alamat_anggota       VARCHAR(30)          not null,
   notlp_anggota        VARCHAR(15)          not null,
   constraint PK_ANGGOTA primary key (id_anggota)
);

/*==============================================================*/
/* Index: ANGGOTA_PK                                            */
/*==============================================================*/
create unique index ANGGOTA_PK on anggota (
id_anggota
);

/*==============================================================*/
/* Index: RELATIONSHIP_8_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_8_FK on anggota (
id_mhs
);

/*==============================================================*/
/* Table: buku                                                  */
/*==============================================================*/
create table buku (
   id_buku              VARCHAR(10)          not null,
   id_kategori          VARCHAR(10)          not null,
   kode_rak             VARCHAR(10)          not null,
   judulbuku            VARCHAR(30)          null,
   pengarang            VARCHAR(30)          null,
   penerbit             VARCHAR(30)          null,
   isbn                 VARCHAR(25)          null,
   jumlah_buku_tersedia INT4                 null,
   constraint PK_BUKU primary key (id_buku)
);

/*==============================================================*/
/* Index: BUKU_PK                                               */
/*==============================================================*/
create unique index BUKU_PK on buku (
id_buku
);

/*==============================================================*/
/* Index: RELATIONSHIP_4_FK                                     */
/*==============================================================*/
create  index RELATIONSHIP_4_FK on buku (
id_kategori
);

/*==============================================================*/
/* Index: DISIMPAN_FK                                           */
/*==============================================================*/
create  index DISIMPAN_FK on buku (
kode_rak
);

/*==============================================================*/
/* Table: detail_peminjaman                                     */
/*==============================================================*/
create table detail_peminjaman (
   id_detail            VARCHAR(10)          not null,
   id_anggota           VARCHAR(10)          null,
   id_pegawai           VARCHAR(10)          null,
   tglpinjam            DATE                 null,
   tglkembali           DATE                 null,
   denda                INT4                 null,
   ket_buku             VARCHAR(25)          null,
   constraint PK_DETAIL_PEMINJAMAN primary key (id_detail)
);

/*==============================================================*/
/* Index: DETAIL_PEMINJAMAN_PK                                  */
/*==============================================================*/
create unique index DETAIL_PEMINJAMAN_PK on detail_peminjaman (
id_detail
);

/*==============================================================*/
/* Index: RELATIONSHIP_12_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_12_FK on detail_peminjaman (
id_anggota
);

/*==============================================================*/
/* Index: RELATIONSHIP_15_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_15_FK on detail_peminjaman (
id_pegawai
);

/*==============================================================*/
/* Table: kategori                                              */
/*==============================================================*/
create table kategori (
   id_kategori          VARCHAR(10)          not null,
   namakategori         VARCHAR(30)          null,
   constraint PK_KATEGORI primary key (id_kategori)
);

/*==============================================================*/
/* Index: KATEGORI_PK                                           */
/*==============================================================*/
create unique index KATEGORI_PK on kategori (
id_kategori
);

/*==============================================================*/
/* Table: mahasiswa                                             */
/*==============================================================*/
create table mahasiswa (
   id_mhs               VARCHAR(11)          not null,
   nama_mhs             VARCHAR(20)          null,
   npm_mhs              VARCHAR(13)          null,
   jurusan              VARCHAR(1024)        null,
   fakultas             VARCHAR(1024)        null,
   constraint PK_MAHASISWA primary key (id_mhs)
);

/*==============================================================*/
/* Index: MAHASISWA_PK                                          */
/*==============================================================*/
create unique index MAHASISWA_PK on mahasiswa (
id_mhs
);

/*==============================================================*/
/* Table: pegawai                                               */
/*==============================================================*/
create table pegawai (
   id_pegawai           VARCHAR(10)          not null,
   nama_pegawai         VARCHAR(30)          not null,
   nip_pegawai          VARCHAR(20)          null,
   alamat_pegawai       VARCHAR(30)          null,
   notlp_pegawai        VARCHAR(15)          null,
   constraint PK_PEGAWAI primary key (id_pegawai)
);

/*==============================================================*/
/* Index: PEGAWAI_PK                                            */
/*==============================================================*/
create unique index PEGAWAI_PK on pegawai (
id_pegawai
);

/*==============================================================*/
/* Table: peminjaman                                            */
/*==============================================================*/
create table peminjaman (
   id_peminjaman        VARCHAR(10)          not null,
   id_detail            VARCHAR(10)          null,
   id_buku              VARCHAR(10)          not null,
   waktu                DATE                 not null,
   constraint PK_PEMINJAMAN primary key (id_peminjaman)
);

/*==============================================================*/
/* Index: PEMINJAMAN_PK                                         */
/*==============================================================*/
create unique index PEMINJAMAN_PK on peminjaman (
id_peminjaman
);

/*==============================================================*/
/* Index: DIPINJAM_FK                                           */
/*==============================================================*/
create  index DIPINJAM_FK on peminjaman (
id_buku
);

/*==============================================================*/
/* Index: RELATIONSHIP_11_FK                                    */
/*==============================================================*/
create  index RELATIONSHIP_11_FK on peminjaman (
id_detail
);

/*==============================================================*/
/* Table: rak_buku                                              */
/*==============================================================*/
create table rak_buku (
   kode_rak             VARCHAR(10)          not null,
   namarak              VARCHAR(30)          null,
   constraint PK_RAK_BUKU primary key (kode_rak)
);

/*==============================================================*/
/* Index: RAK_BUKU_PK                                           */
/*==============================================================*/
create unique index RAK_BUKU_PK on rak_buku (
kode_rak
);

alter table anggota
   add constraint FK_ANGGOTA_RELATIONS_MAHASISW foreign key (id_mhs)
      references mahasiswa (id_mhs)
      on delete restrict on update restrict;

alter table buku
   add constraint FK_BUKU_DISIMPAN_RAK_BUKU foreign key (kode_rak)
      references rak_buku (kode_rak)
      on delete restrict on update restrict;

alter table buku
   add constraint FK_BUKU_RELATIONS_KATEGORI foreign key (id_kategori)
      references kategori (id_kategori)
      on delete restrict on update restrict;

alter table detail_peminjaman
   add constraint FK_DETAIL_P_RELATIONS_ANGGOTA foreign key (id_anggota)
      references anggota (id_anggota)
      on delete restrict on update restrict;

alter table detail_peminjaman
   add constraint FK_DETAIL_P_RELATIONS_PEGAWAI foreign key (id_pegawai)
      references pegawai (id_pegawai)
      on delete restrict on update restrict;

alter table peminjaman
   add constraint FK_PEMINJAM_DIPINJAM_BUKU foreign key (id_buku)
      references buku (id_buku)
      on delete restrict on update restrict;

alter table peminjaman
   add constraint FK_PEMINJAM_RELATIONS_DETAIL_P foreign key (id_detail)
      references detail_peminjaman (id_detail)
      on delete restrict on update restrict;

