<div class="modal fade" id="<?=((isset($id)) ? $id:null)?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">E-Posta Listesi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <textarea style="width: 100%; height: 110px;"><?
                  $x=0;
                  if(isset($data) and is_array($data))
                      foreach ($data as $item):
                          $x++;
                          if(($x % 30) == 0 ) echo  '</textarea><textarea style="width: 100%; height: 110px;">';
                          echo $item['email'].'; ';
                      endforeach;
                  ?></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>


