    <div class="modal fade"  id="<?=((isset($id)) ? $id:null)?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog modal-lg "  role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="exampleModalLabel"><?=((isset($title)) ? $title:null)?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <tbody>

                            <tr class="user-2">
                                <th width="25%">Firma Adı</th>
                                <td><label for="unvan"></label></td>
                            </tr>



                            <tr>
                                <th>Adı Soyadı</th>
                                <td><label for="adi"></label></td>
                            </tr>

                            <tr>
                                <th>Telefon</th>
                                <td><label for="telefon"></label></td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td><label for="email"></label></td>
                            </tr>

                            <tr>
                                <th>Üyelik Tarihi</th>
                                <td><label for="kayit_tarihi"></td>
                            </tr>

                        <tr>
                            <th>Şifre</th>
                            <td><label for="pass"></label></td>
                        </tr>

                        </tbody>
                    </table>
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
