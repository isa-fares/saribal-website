<div class="modal fade" id="<?=((isset($id)) ? $id:null)?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="exampleModalLabel">Hata Detayları</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?

                    if (!empty($data["pos_sonuc"])){
                        echo "<h5>Pos Mesajı</h5>";
                        $xml = simplexml_load_string($data["pos_sonuc"]);
                        $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        $array = json_decode($json,TRUE);

                        echo "<pre>";
                        var_dump($array);
                        echo "</pre>";
                    }

                    if (!empty($data["3d_sonuc"])){
                        echo "<hr><h5>3D Secure Mesajı</h5>";
                        $arr= json_decode($data["3d_sonuc"], true);
                        echo "<pre>"; var_dump($arr); echo "</pre>";
                    }

                ?>


                <?

                ?>


            </div>

        </div>
    </div>
</div>


