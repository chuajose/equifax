<?php if($this->session->flashdata('message')){
    echo '<div class="alert alert-info" role="alert">
    '.$this->session->flashdata('message').'
  </div>';
}?>

<form action="<?php echo base_url();?>asnef/show/<?php echo $id;?>" method="post" id="">
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Fecha de inicio de la operacion</label>
        <input type="text" class="form-control" name="date_start" maxlength="8" placeholder="20170125" value="<?php echo $date_start;?>">
       
    </div>
    <div class="form-group col-md-6">
        <label for="">Fecha finalizacion de la operacion</label>
        <input type="text" class="form-control" id="inputPassword4" name="date_end"  maxlength="8" placeholder="20170125" value="<?php echo $date_end;?>">
        <small id="" class="text-muted ">
            Debe ser mayor o igual a la fecha de inicio de la operacion
        </small>
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-4">
        <label for="">Situacion de la operacion</label>
        <?php echo form_dropdown('situation_operation',$situation_operation,$situation_operation_value, 'class="form-control"');?>
    </div>

    <div class="form-group col-md-4">
        <label for="">Fecha vencimiento 1º cuota impagada</label>
        <input type="text" class="form-control" name="quotas_unpaid_first_date"  maxlength="8" placeholder="20170125" value="<?php echo $quotas_unpaid_first_date;?>">
        <small id="" class="text-muted ">
            Debe ser menor o igual a la fecha vencimiento ultima  cuota impagada<br>
            Debe ser menor o igual a la fecha de fin de la operacion
        </small>
    </div>
    <div class="form-group col-md-4">
        <label for="">Fecha vencimiento ultima  cuota impagada</label>
        <input type="text" class="form-control" name="quotas_unpaid_last_date"  maxlength="8" placeholder="20170125" value="<?php echo $quotas_unpaid_last_date;?>">
        <small id="" class="text-muted ">
            Debe ser mayor o igual a la fecha vencimiento de la 1º  cuota impagada<br>
            Debe ser menor o igual a la fecha de fin de operacion<br>
            Debe ser mayor o igual a la fecha de inicio de operacion
        </small>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Importe del saldo actualmente impagado</label>
        <input type="text" class="form-control" name="balance_unpaid" maxlength="15" placeholder="820,58" value="<?php echo $balance_unpaid;?>">
        <small id="" class="text-muted ">
            Usar coma para separador decimal y nada para millares 15555,25
        </small>
    </div>
    <div class="form-group col-md-6">
        <label for="">Informacion complementaria</label>
        <textarea name="information" maxlength="40" placeholder="" class="form-control"><?php echo $information;?></textarea> 
    </div>
</div>
	
	
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Naturaleza de la persona</label>
        <?php echo form_dropdown('nature_code',$nature_code, $nature_code_value, 'class="form-control"');?>
    </div>
    <div class="form-group col-md-6">
        <label for="">Cif/Nif</label>
        <input type="text" class="form-control" name="cif" maxlength="10" placeholder="" value="<?php echo $cif;?>">
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Nombre</label>
        <input type="text" class="form-control" name="name"  maxlength="30" placeholder="" value="<?php echo $name;?>">
    </div>
    <div class="form-group col-md-6">
        <label for="">Apellidos</label>
        <input type="text" class="form-control" name="surname"  maxlength="80" placeholder="" value="<?php echo $surname;?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Razon social</label>
        <input type="text" class="form-control" name="social_name"  maxlength="80" placeholder="" value="<?php echo $social_name;?>">
    </div>
    <div class="form-group col-md-6">
        <label for="">Tipo de Direccion</label>
        <input type="text" class="form-control" name="address_type"  maxlength="5" placeholder="Calle" value="<?php echo $address_type;?>">
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Direccion</label>
        <input type="text" class="form-control" name="address" maxlength="60" placeholder="Fernando Macias" value="<?php echo $address;?>">
    </div>
    <div class="form-group col-md-6">
        <label for="">Direccion Numero</label>
        <input type="text" class="form-control" name="address_number" maxlength="5" placeholder="30" value="<?php echo $address_number;?>">
    </div>
</div>



<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Mas información sobre direccion</label>
        <input type="text" class="form-control" name="address_other" maxlength="640" placeholder="1º" value="<?php echo $address_other;?>">
    </div>
    <div class="form-group col-md-6">
        <label for="">Codigo Postal</label>
        <input type="text" class="form-control" name="postal_code" maxlength="5" placeholder="15004" value="<?php echo $postal_code;?>">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Telefono</label>
        <input type="text" class="form-control" name="phone" maxlength="20" placeholder="" value="<?php echo $phone;?>">
    </div>
    <div class="form-group col-md-6">
        <label for="">Municipio</label>
        <?php echo form_dropdown('town', $municipio, $town_code_value, 'class="form-control"' );?>
    </div>
</div>
<button role="button" type="submit" class="btn btn-primary">Guardar</button>
<small id="" class="text-danger ">
     Al guardar el registro, automaticamente se pondra en pendiente
    </small>
</form>






