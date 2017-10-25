  <div class="row">
    <div class="col-sm">
    <?php if($registers){?>
        <table class="table">
        <thead><tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Cif/Nif</th>
            <th>Impago</th>
            <th></th>
            <th></th>
        </tr></thead>
        <tbody>
        <?php  foreach($registers as $register){?>
        <tr>
            <?php 
            
            $class = ($register->status=='completed')?'badge-success':'badge-warning';
            echo "<td>".$register->identify."</td>";
            echo "<td>".$register->name." ".$register->surname." ".$register->social_name."</td>";
            echo "<td>".$register->cif."</td>";
            echo "<td>".$register->balance_unpaid."</td>";
            echo "<td>".$register->errors."</td>";
            echo "<td><a href='".base_url()."/asnef/show/".$register->identify."'>Ver</a></td>";
            ?>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        <?php }else{
            ?>
            <div class="alert alert-primary" role="alert">
                No existen registros con errrores
            </div>
            <?php
        } ?>
    </div>
</div>
