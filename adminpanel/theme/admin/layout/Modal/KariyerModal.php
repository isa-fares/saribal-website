<style>
    .kariyerDetayRow .imageBlok{
        position: absolute;
        top: 19px;
        right: 26px;
        width: 195px;
        height: 220px;
        z-index: 5;
        border: 5px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        background-color: #fff;
    }

    .kariyerDetayRow .imageBlok.disable{
        display: none;
        opacity: 0;
        visibility: hidden;
    }

    .kariyerDetayRow .imageBlok img{
        height: 100%;
        transform: translate(-50%);
        position: absolute;
        left: 50%;
        width: auto;
        max-width: inherit;
    }
    .kariyerDetayRow strong {
        font-weight: 700;
        margin: 0 !important;
    }
    .kariyerDetayRow .table tr td,
    .kariyerDetayRow .table tr th{
        border-color:#e0e0e0 !important;
    }

    .kariyerDetayRow label {
        margin-bottom: 0;
    }
</style>
<div class="modal"  id="<?=((isset($id)) ? $id:null)?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-id="" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="d-flex justify-content-between flex-grow">
                    <div class="d-flex">
                        <strong class="font-size-18 mb-0">Başvuru Tarihi: </strong>
                        <label class="font-size-18 mb-0 ml-2" for="basvuru_tarihi"></label>
                    </div>
                    <div class="d-flex">
                        <p class="float-right durumu font-size-18 mb-0">Durumu :  <label for="durumu"></label></p>
                    </div>
                </div>


            </div>
            <div class="modal-body">
                <div class="row align-items-center mb-30">

                    <div class="col-lg-4">
                        <h3 class="text-behance mb-0 mt-0"><label for="adi_soyadi"></label> </h3>
                    </div>
                    <div class="col-lg-8 col-lg-offset-1 tarihler">
                        <button type="button" class="btn bg-green pull-right changeType" data-text="Onaylandı"  data-type="1" >Onaylandı</button>
                        <button type="button" class="btn btn-primary pull-right changeType" style="margin-right: 10px;" data-text="Olumlu" data-type="2"  >Olumlu</button>
                        <button type="button" class="btn btn-danger pull-right changeType" style="margin-right: 10px;" data-text="Olumsuz" data-type="3"  >Olumsuz</button>
                        <button type="button" class="btn btn-warning pull-right changeType" style="margin-right: 10px;" data-text="Red Edildi" data-type="4"  >Red Edildi</button>
                        <a target="_blank" data-url="<?=$this->BaseAdminURL('Kariyer/yazdir/')?>" href="#" style="margin-right: 10px;" class="btn btn-default pull-right yazdirButon">YAZDIR</a>
                        <br clear="all">
                    </div>
                </div>
                <style>
                    table tr td{
                        border:1px solid #ccc;
                        padding:5px;
                    }

                    table tr td label {
                        font-weight: 500;
                    }
                </style>
                <div class="row kariyerDetayRow" class="">
                    <div class="col-lg-12">

                        <table border="0" borderColor="#ccc" cellpadding="5" class="table table-bordered " style="width:100%; position: relative;">
                            <!-- <div class="imageBlok disable">
                                 <img src="">
                             </div>-->

                            <!--<div class="cvBlok d-none">
                                <a href="#" target="_blank" class="text-danger text-bold">Kişinin Cv Dosyasını İndirmek İçin Tıklayınız</a>
                            </div>-->

                            <tr>
                                <td width="30%"  colspan="5" align="left"><strong><h3>KİMLİK BİLGİLERİ</h3></strong></td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>ADI SOYADI</strong></td>
                                <td colspan="4"><label for="adi_soyadi"></label></td>
                            </tr>
                            <tr>
                                <td><strong>T.C. KİMLİK NO</strong></td>
                                <td colspan="4"><label for="tc_kimlik"></label></td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>CİNSİYET</strong></td>
                                <td colspan="4"><label for="cinsiyet"></label></td>
                            </tr>

                            <!--<tr>
                                <td width="30%"><strong>BOY</strong></td>
                                <td colspan="4"><label for="boy"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>KİLO</strong></td>
                                <td colspan="4"><label for="kilo"></label></td>
                            </tr>


                            <tr>
                                <td width="30%"><strong>DOĞUM TARİHİ</strong></td>
                                <td colspan="4"><label for="dogum_yeri_ve_tarihi"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>İKAMETGAH İLİ</strong></td>
                                <td colspan="4"><label for="ik_il"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>İKAMETGAH İLÇESİ</strong></td>
                                <td colspan="4"><label for="ik_ilce"></label></td>
                            </tr>-->

                            <tr>
                                <td width="30%"><strong>ADRESİ</strong></td>
                                <td colspan="4"><label for="adresi"></label></td>
                            </tr>


                            <tr>
                                <td width="30%"><strong>CEP TELEFONU</strong></td>
                                <td colspan="4"><label for="cep_telefonu"></label></td>
                            </tr>


                            <tr>
                                <td width="30%"><strong>MESLEĞİ</strong></td>
                                <td colspan="4"><label for="meslek"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>TAHSİL DURUMU</strong></td>
                                <td colspan="4"><label for="tahsil"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>ENGELLİLİK ORANI</strong></td>
                                <td colspan="4"><label for="engellilik"></label></td>
                            </tr>





                            <!--<tr>
                                  <td width="30%" colspan="5" align="center"><strong><h3>KİŞİSEL BİLGİLER</h3></strong></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>EHLİYET DURUMU</strong></td>
                                  <td colspan="4"><label for="ehliyet"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>ASKERLİK DURUMU</strong></td>
                                  <td colspan="4"><label for="askerlik"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>ASKERLİK TECİL TARİHİ</strong></td>
                                  <td colspan="4"><label for="tecil_tarih"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>KALICI RAHATSIZLIĞI</strong></td>
                                  <td colspan="4"><label for="rahatsizlik"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>TAHSİL DURUMU</strong></td>
                                  <td colspan="4"><label for="tahsil"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>MEDENİ HAL</strong></td>
                                  <td colspan="4"><label for="medeni_hal"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>ÇOCUK SAYISI</strong></td>
                                  <td colspan="4"><label for="cocuk_sayisi"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>AİLEDE ÇALIŞAN VAR MI?</strong></td>
                                  <td colspan="4"><label for="aile_calisan"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>ENGELLİLİK ORANI</strong></td>
                                  <td colspan="4"><label for="engellilik"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>SABIKANIZ VAR MI?</strong></td>
                                  <td colspan="4"><label for="sabika"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>İCRA TAKİBİ VAR MI?</strong></td>
                                  <td colspan="4"><label for="icra_takibi"></label></td>
                              </tr>


                              <tr>
                                  <td width="30%"><strong>HANGİ BÖLÜMDE ÇALIŞMAK İSTERSİNİZ ?</strong></td>
                                  <td colspan="4"><label for="istenen_bolum"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>ÇALIŞMAK İSTENEN YER ?</strong></td>
                                  <td colspan="4"><label for="calismak_istenen_yer"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>KATILDIĞINIZ KURS VE SEMİNERLER</strong></td>
                                  <td colspan="4"><label for="kurslar"></label></td>
                              </tr>

                              <tr>
                                  <td width="30%"><strong>REFERANSLAR</strong></td>
                                  <td colspan="4"><label for="referans"></label></td>
                              </tr>
                              -->


                        </table>


                        <!--<table border="0" class="table table-bordered " >
                            <tr>
                                <td width="30%"  colspan="5" align="center"><strong><h3>GEÇMİŞTE ÇALIŞTIĞI İŞYERLERİ (1)</h3></strong></td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>FİRMA ADI</strong></td>
                                <td colspan="4"><label for="firma_adi_1"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>FİRMA İRTİBAT TELEFONU</strong></td>
                                <td colspan="4"><label for="firma_telefon_1"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>GÖREVİNİZ</strong></td>
                                <td colspan="4"><label for="firma_gorev_1"></label></td>
                            </tr>


                            <tr>
                                <td width="30%"><strong>ÇALIŞMA SÜRESİ</strong></td>
                                <td colspan="4"><label for="calisma_suresi_1"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>AYRILIŞ NEDENİ</strong></td>
                                <td colspan="4"><label for="ayrilik_nedeni_1"></label></td>
                            </tr>



                        </table>

                        <table border="0" class="table table-bordered " >
                            <tr>
                                <td width="30%"  colspan="5" align="center"><strong><h3>GEÇMİŞTE ÇALIŞTIĞI İŞYERLERİ (2)</h3></strong></td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>FİRMA ADI</strong></td>
                                <td colspan="4"><label for="firma_adi_2"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>FİRMA İRTİBAT TELEFONU</strong></td>
                                <td colspan="4"><label for="firma_telefon_2"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>GÖREVİNİZ</strong></td>
                                <td colspan="4"><label for="firma_gorev_2"></label></td>
                            </tr>



                            <tr>
                                <td width="30%"><strong>ÇALIŞMA SÜRESİ</strong></td>
                                <td colspan="4"><label for="calisma_suresi_2"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>AYRILIŞ NEDENİ</strong></td>
                                <td colspan="4"><label for="ayrilik_nedeni_2"></label></td>
                            </tr>



                        </table>


                        <table border="0" class="table table-bordered " >
                            <tr>
                                <td width="30%"  colspan="5" align="center"><strong><h3>GEÇMİŞTE ÇALIŞTIĞI İŞYERLERİ (3)</h3></strong></td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>FİRMA ADI</strong></td>
                                <td colspan="4"><label for="firma_adi_3"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>FİRMA İRTİBAT TELEFONU</strong></td>
                                <td colspan="4"><label for="firma_telefon_3"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>GÖREVİNİZ</strong></td>
                                <td colspan="4"><label for="firma_gorev_3"></label></td>
                            </tr>


                            <tr>
                                <td width="30%"><strong>ÇALIŞMA SÜRESİ</strong></td>
                                <td colspan="4"><label for="calisma_suresi_3"></label></td>
                            </tr>

                            <tr>
                                <td width="30%"><strong>AYRILIŞ NEDENİ</strong></td>
                                <td colspan="4"><label for="ayrilik_nedeni_3"></label></td>
                            </tr>



                        </table>-->



                    </div>




                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Kapat</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
