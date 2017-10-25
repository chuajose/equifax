

<div class="row">
    <div class="col-sm">
        <a href="<?php echo base_url();?>asnef/create" class="btn btn-primary">Crear Registro</a>
    </div>
    <div class="col-sm">
        <form action="<?php echo base_url();?>asnef/errors" method="post" id="errors" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlFile1">Importar Errores</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="userfile">
            </div>
            <button type="submit" class="btn btn-primary">Importar</button>
        </form>
    </div>
  </div>
  <div class="row">
<div class="col-sm-12">
<form class="form-inline" action="<?php echo base_url();?>asnef/<?php echo $this->uri->segment(2);?>" method="post">
  <div class="form-group">
    <input type="text"  class="form-control" id="staticEmail2" name="search" value="" placeholder="Buscar">
  </div>

  <button type="submit" class="btn btn-primary">Buscar</button>
</form>
</div>
</div>
  <div class="row">
    <div class="col-sm">
        <table class="table">
        <thead><tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Cif/Nif</th>
            <th>Impago</th>
            <th>Fichero</th>
            <th>Estado</th>
            <th></th>
        </tr></thead>
        <tbody>
        <?php if($registers){ foreach($registers as $register){?>
        <tr>
            <?php 
            $class = ($register->status=='completed')?'badge-success':'badge-warning';
            echo "<td>".$register->identify."</td>";
            echo "<td>".$register->name." ".$register->surname." ".$register->social_name."</td>";
            echo "<td>".$register->cif."</td>";
            echo "<td>".$register->balance_unpaid."</td>";
            echo "<td><a href='".base_url()."asnef/showFile/".$register->in_file."'>".$register->in_file."</a></td>";
            echo "<td><span class='badge ".$class."'>".$register->status."</td>";
            echo "<td>";
            if($register->status != 'completed')echo "<a class='btn btn-danger btn-sm' href='".base_url()."asnef/remove/".$register->identify."'>Borrar</a>";
            echo " <a class='btn btn-info btn-sm' href='".base_url()."asnef/show/".$register->identify."'>Ver</a>";
            echo "</td>";
            ?>
        </tr>
        <?php } }?>
        </tbody>
        </table>
        <?php if($generate){?><a  class="btn btn-info" href="<?php echo base_url();?>asnef/generate">Generar Fichero</a><?php } ?>
    </div>
</div>
