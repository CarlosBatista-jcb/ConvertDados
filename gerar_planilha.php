<?php
require 'vendor/autoload.php'; // Inclua o autoload do Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crie uma instância da planilha
$spreadsheet = new Spreadsheet();

// Adicione conteúdo à planilha (exemplo)
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Nome');
$sheet->setCellValue('B1', 'Idade');

$writer = new Xlsx($spreadsheet);
$writer->save('hello_world.xlsx');

// Dados fictícios para preencher a planilha (você pode substituir por seus próprios dados)
$dados = [
    ['Carlos', 30],
    ['Maria', 25],
    ['João', 35],
];

// Preencha os dados da planilha a partir do array $dados
$row = 2; // Comece na segunda linha
foreach ($dados as $item) {
    $col = 'A';
    foreach ($item as $valor) {
        $sheet->setCellValue($col . $row, $valor);
        $col++;
    }
    $row++;
}
// Estilos CSS para controlar o tamanho das imagens (ajuste conforme necessário)
//$sheet->getHeaderFooter()->setOddHeaderImage($footerImage);
//$sheet->getHeaderFooter()->setOddFooterImage($headerImage);


// Defina o nome do arquivo
$filename = 'dados_capturados.xlsx';

// Defina o tipo de resposta
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=\"$filename\"");
header('Cache-Control: max-age=0');

// Crie um objeto de escrita para salvar a planilha
$writer = new Xlsx($spreadsheet);

// Saída para o navegador
$writer->save('php://output');







