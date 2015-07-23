<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DocumentoModel extends CI_Model {
    var $SECUENCIA='';
    var $TIPO_DOC='';
    var $NUM_DOC='';
    var $ESTABLECIMIENTO='';
    var $PTO_EMISION='';
    var $FECHA='';
    var $TIPO_ID_CLIENTE='';
    var $ID_CLIENTE='';
    var $RAZONS_CLIENTE='';
    var $RAZONC_CLIENTE='';
    var $CONT_ESPECIAL='';
    var $LLEVA_CONTAB='';
    var $DIRECCION_CLIENTE='';
    var $ESTADO='';
    var $empresa='';
    var $cod_cliente_int='';
    var $TIPO_COMP_MODIFICA='';
    var $NUM_COMP_MODIFICA='';
    var $FEC_COMP_MODIFICA='';
    var $MOTIVO='';
    var $DETALLE_DOCUMENTO;
    var $TIPO_DOCUMENTO;
    var $TOTAL=0;
    var $ArchivoDocumento;
    var $TipoCliente;
    var $Empresa;
    var $ESTABLECIMIENTO_PTO_EMISION;

    var $DocumentoXML;
    var $DocumentoPDF;
    

    var $_table="cab_documento";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('DetalleDocumentoModel','DetalleDocumento');        
        $this->load->model('TipoDocumentoModel','TipoDocumento');        
        $this->load->model('ArchivoDocumentoModel','ArchivoDocumentoInfo');   
        $this->load->model('TipoClienteModel','TipoClienteInfo');      
        $this->load->model('EmpresaModel','EmpresaInfo');      
    }
    
    function getDocumentos($count=10)
    {
        
        if ($count==-1){
        $query = $this->db->get($_table);    
        }else{
        $query = $this->db->get($_table, $count);
        }
        return $query->result();
    }

    function getCount(){
        return $this->db->count_all($_table);
    }

    
    function EBool($value){
        if ($value==null){return 0;}
        if($value=='' || $value==True || $value=='on'){return 1;}
        return 0;
    }

    function GetById($id){
        $result = $this->db->query("SELECT * FROM $this->_table WHERE NUM_DOC=$id");
        $r=$result->row();
        $this->SECUENCIA=$r->SECUENCIA;
        $this->TIPO_DOC=$r->TIPO_DOC;
        $this->NUM_DOC=$r->NUM_DOC;
        $this->ESTABLECIMIENTO=$r->ESTABLECIMIENTO;
        $this->PTO_EMISION=$r->PTO_EMISION;
        $this->FECHA=$r->FECHA;
        $this->TIPO_ID_CLIENTE=$r->TIPO_ID_CLIENTE;
        $this->ID_CLIENTE=$r->ID_CLIENTE;
        $this->RAZONS_CLIENTE=$r->RAZONS_CLIENTE;
        $this->RAZONC_CLIENTE=$r->RAZONC_CLIENTE;
        $this->CONT_ESPECIAL=$r->CONT_ESPECIAL;
        $this->LLEVA_CONTAB=$r->LLEVA_CONTAB;
        $this->DIRECCION_CLIENTE=$r->DIRECCION_CLIENTE;
        $this->ESTADO=$r->ESTADO;
        $this->empresa=$r->empresa;
        $this->cod_cliente_int=$r->cod_cliente_int;
        $this->TIPO_COMP_MODIFICA=$r->TIPO_COMP_MODIFICA;
        $this->NUM_COMP_MODIFICA=$r->NUM_COMP_MODIFICA;
        $this->FEC_COMP_MODIFICA=$r->FEC_COMP_MODIFICA;
        $this->MOTIVO=$r->MOTIVO;
        $this->DETALLE_DOCUMENTO = $this->DetalleDocumento->GetByIdCabecera($this->SECUENCIA);

        return $r;
    }

    function GetDocumentoByClienteId($id_cliente,$filters=''){
        $op=0;
        $sql="SELECT * FROM $this->_table WHERE 1=1";
        if($id_cliente!="administrador"){        
            $sql.=" AND ESTADO='V' AND ID_CLIENTE='$id_cliente'";    
        }

        if($filters!=''){
            if($filters["tipo_documento"]!='' && $filters["tipo_documento"]!="0"){
                $sql.=" and TIPO_DOC='".$filters['tipo_documento']."'";
            }
            if ($filters["fecha_inicial"]!='' && $filters["fecha_final"]!='') {
                $sql.=" and FECHA between '".$filters["fecha_inicial"]."' AND '".$filters["fecha_final"]."'";
            }elseif ($filters["fecha_inicial"]!='') {
                $sql.=" and FECHA >= '".$filters["fecha_inicial"]."'";
            }elseif ($filters["fecha_final"]!='') {
                $sql.=" and FECHA <= '".$filters["fecha_final"]."'";
            }
        }
        $query = $this->db->query($sql);   
        $array = array();
        foreach ($query->result() as $r)
        {
            $doc=new DocumentoModel();
            $doc->SECUENCIA=$r->SECUENCIA;
            $doc->TIPO_DOC=$r->TIPO_DOC;
            $doc->NUM_DOC=$r->NUM_DOC;
            $doc->ESTABLECIMIENTO=$r->ESTABLECIMIENTO;
            $doc->PTO_EMISION=$r->PTO_EMISION;
            $doc->FECHA=$r->FECHA;
            $doc->TIPO_ID_CLIENTE=$r->TIPO_ID_CLIENTE;
            $doc->ID_CLIENTE=$r->ID_CLIENTE;
            $doc->RAZONS_CLIENTE=$r->RAZONS_CLIENTE;
            $doc->RAZONC_CLIENTE=$r->RAZONC_CLIENTE;
            $doc->CONT_ESPECIAL=$r->CONT_ESPECIAL;
            $doc->LLEVA_CONTAB=$r->LLEVA_CONTAB;
            $doc->DIRECCION_CLIENTE=$r->DIRECCION_CLIENTE;
            $doc->ESTADO=$r->ESTADO;
            $doc->empresa=$r->empresa;
            $doc->cod_cliente_int=$r->cod_cliente_int;
            $doc->TIPO_COMP_MODIFICA=$r->TIPO_COMP_MODIFICA;
            $doc->NUM_COMP_MODIFICA=$r->NUM_COMP_MODIFICA;
            $doc->FEC_COMP_MODIFICA=$r->FEC_COMP_MODIFICA;
            $doc->MOTIVO=$r->MOTIVO;
            //$doc->DETALLE_DOCUMENTO = $this->DetalleDocumento->GetByIdCabecera($doc->SECUENCIA);
            $doc->TIPO_DOCUMENTO=$this->TipoDocumento->GetById($doc->TIPO_DOC);
            //$doc->TOTAL=$this->DetalleDocumento->GetTotal($doc->SECUENCIA);
            //$doc->ArchivoDocumento=$this->ArchivoDocumentoInfo->GetById($doc->SECUENCIA);
            //$doc->TipoCliente=$this->TipoClienteInfo->GetById($doc->TIPO_ID_CLIENTE);
            //$doc->Empresa=$this->EmpresaInfo->GetById($doc->empresa);
            $doc->ESTABLECIMIENTO_PTO_EMISION= $r->ESTABLECIMIENTO.'-'.$r->PTO_EMISION;
            $doc->DocumentoXML=$this->ArchivoDocumentoInfo->GetById($doc->SECUENCIA);            
            $path=$doc->DocumentoXML->ruta_xml;
            $path=str_replace("c:","",str_replace("C:", "", $path));            
            $doc->DocumentoXML=preg_replace('/^.+\\\\/', '', $path);
            $doc->DocumentoPDF=str_replace('.xml', '.pdf', $doc->DocumentoXML);


            array_push($array, $doc);
        }

        return $array;
    }

    function GetTotalCompras($id_cliente){
        $sql="select coalesce(SUM(BASE_IMP_IVA)+SUM(VALOR_IVA)-SUM(DESCUENTO),0) AS TOTAL from cab_documento c
                inner join det_documento d on c.SECUENCIA=d.SECUENCIA_CAB
                where c.ID_CLIENTE='$id_cliente'";
        $query = $this->db->query($sql);        
        $row = $query->row();
        return $row->TOTAL;
    }

    function GetTotalMesActual($id_cliente){
        $sql="select coalesce(SUM(BASE_IMP_IVA)+SUM(VALOR_IVA)-SUM(DESCUENTO),0) AS TOTAL from cab_documento c
                inner join det_documento d on c.SECUENCIA=d.SECUENCIA_CAB
                where c.ID_CLIENTE='$id_cliente' and Month(c.FECHA)=Month(now());";
        $query = $this->db->query($sql);        
        $row = $query->row();
        return $row->TOTAL;
    }

    function GetCantidadPorTipoDocumento($id_cliente,$tipo_documento){
        $sql="select COUNT(TIPO_DOC) as CANTIDAD FROM cab_documento c WHERE c.TIPO_DOC='$tipo_documento'";
        if($id_cliente!="administrador"){
            $sql.=" and c.ID_CLIENTE='$id_cliente' and ESTADO='V'";   
        }
        $query = $this->db->query($sql);        
        $row = $query->row();
        return $row->CANTIDAD;   
    }

    function ReporteByClienteId($usuario,$filters=''){
        $op=0;
        $sql="select c.tipo_doc,t.nombre as tipo_doc_desc,c.num_doc,c.fecha,c.razons_cliente,
        d.descripcion_item,d.cantidad,d.precio,d.descuento,d.base_imp_iva,d.valor_iva,(d.base_imp_iva+d.valor_iva) as total
        from `cab_documento` c
        inner join `det_documento` d on c.SECUENCIA=d.SECUENCIA_CAB
        inner join `tipo_documento` t on t.CODIGO=c.TIPO_DOC";
		$sql.=" WHERE 1=1 ";
        if($usuario->is_admin==0){
            $sql.=" and c.id_cliente='$usuario->cedula'";
        }
        if($filters!=''){
            if($filters["tipo_documento"]!='' && $filters["tipo_documento"]!="0"){
                $sql.=" and c.TIPO_DOC='".$filters['tipo_documento']."'";
            }
            if ($filters["fecha_inicial"]!='' && $filters["fecha_final"]!='') {
                $sql.=" and c.FECHA between '".$filters["fecha_inicial"]."' AND '".$filters["fecha_final"]."'";
            }elseif ($filters["fecha_inicial"]!='') {
                $sql.=" and c.FECHA >= '".$filters["fecha_inicial"]."'";
            }elseif ($filters["fecha_final"]!='') {
                $sql.=" and c.FECHA <= '".$filters["fecha_final"]."'";
            }
        }
		$sql.=" UNION ";
		$sql.=" SELECT c.tipo_doc,t.nombre AS tipo_doc_desc,c.num_doc,c.fecha,c.razons_cliente,
        d.codigo AS descripcion_item,d.codigoretencion AS cantidad,d.base AS precio,porcentaje AS descuento,0 AS base_imp_iva,
        0 AS valor_iva,(d.valorRetenido) AS total
        FROM cab_documento c
        INNER JOIN det_retencion d ON c.SECUENCIA=d.CAB_DOCUMENTO
        INNER JOIN tipo_documento t ON t.CODIGO=c.TIPO_DOC
        ";
		$sql.=" WHERE 1=1 ";
        if($usuario->is_admin==0){
            $sql.=" and c.id_cliente='$usuario->cedula'";
        }
        if($filters!=''){
            if($filters["tipo_documento"]!='' && $filters["tipo_documento"]!="0"){
                $sql.=" and c.TIPO_DOC='".$filters['tipo_documento']."'";
            }
            if ($filters["fecha_inicial"]!='' && $filters["fecha_final"]!='') {
                $sql.=" and c.FECHA between '".$filters["fecha_inicial"]."' AND '".$filters["fecha_final"]."'";
            }elseif ($filters["fecha_inicial"]!='') {
                $sql.=" and c.FECHA >= '".$filters["fecha_inicial"]."'";
            }elseif ($filters["fecha_final"]!='') {
                $sql.=" and c.FECHA <= '".$filters["fecha_final"]."'";
            }
        }
        $query = $this->db->query($sql); 
        return $query;
    }


}
