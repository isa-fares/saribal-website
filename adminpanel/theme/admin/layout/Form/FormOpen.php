                        <form action="<?=((isset($action) ? $action :''))?>"
                              id="<?=((isset($id) ? $id :''))?>"
                              class="<?=((isset($class) ? $class :''))?>"
                              method="<?=((isset($method) ? $method :''))?>"
                              <? if (isset($autocomplete)) { echo 'autocomplete="'.$autocomplete.'"'; }?>
                              novalidate
                          >

<div class="row">