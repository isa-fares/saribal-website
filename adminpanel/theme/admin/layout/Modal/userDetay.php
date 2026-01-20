<?
$user = $this->dbConn->teksorgu("SELECT * FROM uyeler WHERE id = $user_id");
?>
<div class="modal fade" id="<?=((isset($id)) ? $id:null)?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel"><?=($user["tur"] == "2") ? "Firma Bilgileri" : "Üye Bilgileri"?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

               <table class="table table-striped table-bordered">
                   <tbody>


                    <tr>
                        <th width="25%">Firma Adı</th>
                        <td><?= $this->temizle($user["firma_adi"]) ?></td>
                    </tr>


                        <tr>
                            <th>Adı Soyadı</th>
                            <td><?= $this->temizle($user["adi"]) ?></td>
                        </tr>


                        <tr>
                            <th>Telefon</th>
                            <td><?=$this->temizle($user["telefon"])?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?=$this->temizle($user["email"])?></td>
                        </tr>


                        <tr>
                            <th>Üyelik Tarihi</th>
                            <td><?=$this->temizle($user["kayit_tarihi"])?></td>
                        </tr>

                   </tbody>
               </table>
            </div>

        </div>
    </div>
</div>


