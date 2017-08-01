<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use \FPDF as FPDF;

class IndexController extends AbstractActionController
{
    public function indexAction() {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $em->getRepository("Application\Entity\Pecas");

        $listaPecas = $repo->findAll();

        return new ViewModel(array('listaPecas'=>$listaPecas));
    }

    public function loginAction() {

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $em->getRepository("Application\Entity\Usuarios");

        $logar = $repo->logar();

        return new JsonModel(array('success'=>false));
        // return new ViewModel(array('logar'=>$logar));
    }

    public function atualizarservidorAction() {

        return new ViewModel(array('success'=>true));
    }

    public function producaomesAction() {

        return new ViewModel(array('success'=>true));
    }

    public function gerarpdfAction() {

        if ($_POST['dataInicial'] == '') {
            $hoje = date('Y-m-d');
            $ano = date('Y');

            $diaInicial = 16;
            $diaFinal = 15;
            $mesInicial = date('m') - 2;
            $mesFinal = date('m') - 1;

            // $data = new DateTime('22-01-1990');
            // $data->setDate($ano, $mesInicial, $diaInicial);
            // $dataInicial = $data->format('Y-m-d');
            $dataInicial = $ano. '-'.$mesInicial.'-'.$diaInicial;
            $dataFinal = $ano. '-'.$mesFinal.'-'.$diaFinal ;
            // echo "Data Inicial.: " . $dataInicial . " Data Final.: " . $dataFinal;
        } else {
            $dataInicial = $_POST['dataInicial'];
            $dataFinal = $_POST['dataFinal'];
        }
        // require_once("vendor/setasign/fpdf/fpdf.php");

        $pdf = new FPDF('P', 'mm', 'A4');

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        // $dataInicial = $_POST['dataInicial'];
        // $dataFinal = $_POST['dataFinal'];
        $data = $em->getRepository('Application\Entity\Trampo')->gerarpdf($dataInicial,$dataFinal);

        $cont = 1;
        $total = 0;
        $qtdcielo = 0;
        $qtdget = 0;
        $qtdstone = 0;
        $qtdelavon = 0;
        $qtdcielotef = 0;

        $pdf -> AddPage();

        $Y_Fields_Name_position = 20;
        $Y_Table_Position = 26;
        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(80);
        $pdf->Cell(20,10,'Data Inicial.: ' . $dataInicial . ' Data Final.: ' . $dataFinal,0,1,'C');
        $pdf->SetY($Y_Fields_Name_position);
        $pdf->SetX(10);
        $pdf->Cell(185,6,'NRO_OS              - EC                        -' . utf8_decode('Máquina') ,1,0,'L',1);
            // $pdf->SetX(105);
            // $pdf->Cell(40,6,'NRO_OS',1,0,'L');
            // $pdf->SetX(145);
            // $pdf->Cell(40,6,'Data',1,0);
            //Now show the 3 columns
        foreach ($data as $dados){

            if( $cont % 41 == 0){
                $pdf -> AddPage();
                $Y_Fields_Name_position = 20;
                $Y_Table_Position = 26;
            }

            $dt = implode('-', array_reverse(explode('-', $dados->getData()->format('Y-m-d'))));
            if(strpos($dados->getConclusao(),'CIELO-TEF')){
                $qtdcielotef += 1;
                $txt = $dados->getNroos()." - ".utf8_decode($dados->getEc()).' - CIELO-TEF - ' . $dt;
            }
            elseif(strpos($dados->getConclusao(),'CIELO')){
                $qtdcielo += 1;
                $txt = $dados->getNroos()." - ".utf8_decode($dados->getEc()).' - CIELO ' . $dt;
            }
            elseif (strpos($dados->getConclusao(), 'GET')){
                    $qtdget += 1;
                $txt = $dados->getNroos()." - ".utf8_decode($dados->getEc()).' - GET ' . $dt;
            }
            elseif (strpos($dados->getConclusao(), 'STONE')){
                $qtdstone += 1;
                $txt = $dados->getNroos()." - ".utf8_decode($dados->getEc()).' - STONE ' . $dt;
            }
            elseif (strpos($dados->getConclusao(), 'ELAVON')){
                $qtdelavon += 1;
                $txt = $dados->getNroos()." - ".utf8_decode($dados->getEc()).' - ELAVON ' . $dt;
            }
            $pdf->SetY($Y_Table_Position);
            $pdf->SetX(10);
            $pdf->MultiCell(185,6,$txt,1,'J');
                // $pdf->MultiCell(95,6,utf8_decode($dados->getEc()),1,'J');
                // $pdf->SetX(105);
                // $pdf->MultiCell(40,6,$dados->getNroos(),1,'J');
                // $pdf->SetX(145);
                // $pdf->MultiCell(40,6,$dt,1,'J');
            $Y_Table_Position += 6;
            $cont++;
            $total += $dados->getValor();
        }
        $cont--;
        $pdf->ln();
        $pdf->Write(5,'Total.: R$ ' . number_format($total, 2));
        $pdf->ln();
        $pdf->Write(5,'Total de ' . utf8_decode('Máquina - CIELO') . ': ' . $qtdcielo);
        $pdf->ln();
        $pdf->Write(5,'Total de ' . utf8_decode('Máquina - CIELO - TEF') . ': ' . $qtdcielotef);
        $pdf->ln();
        $pdf->Write(5,'Total de ' . utf8_decode('Máquina - GET') . ': ' . $qtdget);
        $pdf->ln();
        $pdf->Write(5,'Total de ' . utf8_decode('Máquina - STONE') . ': ' . $qtdstone);
        $pdf->ln();
        $pdf->Write(5,'Total de ' . utf8_decode('Máquina - ELAVON') . ': ' . $qtdelavon);
        $pdf->ln();
        $pdf->Write(5,'-----------------------------------------------------------');
        $pdf->ln();
        $pdf->Write(5,'Total de ' . utf8_decode('Máquina') . ': ' . $cont);
        $pdf->Output();
        $this->_helper->layout->disableLayout();
    }

}
