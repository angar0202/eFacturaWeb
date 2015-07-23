
<div class="row" id="documentos">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2 style="font-size:12px"><i class="glyphicon glyphicon-file"></i> Documentos</h2>
    </div>
    <div class="box-content">    
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Emisión</th>
        <th>Tipo Documento</th>
        <th>Núm. Comprobante</th>        
        <th>Cliente</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?
    foreach ($documentos as $doc) 
    {
    ?>
        <tr>
        <td><?=$doc->FECHA?></td>

        <td class="center">
        <?php
        if($is_admin){
        switch ($doc->ESTADO) {
            case 'A':
                $style="label-info";
                break;
            case 'I':
                $style="";
                break;
                case 'L':
                $style="success";
                break;
                case 'P':
                $style="label-warning";
                break;
                case 'R':
                $style="label-important";
                break;
                case 'V':
                $style="label-success";
                break;
		case 'E':
                $style="";
                break;
        }

        ?>

        <span class="label-default label <?=$style?>"><?=$doc->ESTADO?></span>
        <?php
        }
        ?>
        <?=$doc->TIPO_DOCUMENTO->NOMBRE?>
        </td>
        <td class="center"><?=$doc->ESTABLECIMIENTO_PTO_EMISION .'-'. $doc->NUM_DOC?></td>        
        <td class="center"><?=$doc->RAZONS_CLIENTE?>
        </td>        
        
        <td class="center" width="100px">
            <a class="btn btn-danger btn-sm" target="_blank" href="<?=base_url()?>docs/<?=$doc->ID_CLIENTE?>/<?=$doc->TIPO_DOC?>/<?=$doc->DocumentoPDF?>">
                <i class="fa fa-file-pdf-o"></i>
            </a> 
            <a class="btn btn-info btn-sm" target="_blank" href="<?=base_url()?>docs/<?=$doc->ID_CLIENTE?>/<?=$doc->TIPO_DOC?>/<?=$doc->DocumentoXML?>">
                <i class="fa fa-file-code-o"></i>
            </a>
        </td>
    </tr>
    <?
    }
    ?>
    
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->
    </div><!--/row-->
<?php if (isset($ajax_req)): ?>    
<script type="text/javascript" src="http://jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.columnFilter.js"></script>
<script src="<?=site_url()?>js/tabla.js"></script>
<?php endif;?>
