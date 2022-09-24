<?php declare(strict_types=1);

namespace domain\workReport;

use domain\documentBuilder\DocumentBuilderInterface;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\SimpleType\JcTable;

class DocumentBuilder implements DocumentBuilderInterface
{
	private PhpWord $document;
	private Table $table;
	private Section $section;
	private array $styles;

	private ?DocumentInfoDto $documentInfoDto = null;

	public function setDto(DocumentInfoDto $dto): void
	{
		$this->documentInfoDto = $dto;
	}

	public function build(): PhpWord
	{
		$this->guardDocumentInfoDtoIsset();

		$this->document = new PhpWord();
		$this->section = $this->document->addSection();

		$this->addStyles();
		$this->buildHeader();
		$this->buildTable();

		return $this->document;		
	}

	private function guardDocumentInfoDtoIsset()
	{
		if (!$this->documentInfoDto) {
			throw new \DomainException('You should set $documentInfoDto using setDto() first');
		}
	}

	private function addStyles()
	{
		$this->document->setDefaultFontName('Times New Roman');
		$this->document->setDefaultFontSize(14);

		$this->document->addParagraphStyle('alignCenter', [
		    'align' => 'center'
		]); 
		$this->document->addParagraphStyle('alignRight', [
		    'align' => 'right'
		]); 

		$this->styles = [
		    'headerStyles' => [
		    ],
		    'font' => [
		    ],

		    'tableStyleName' => 'Default Table',
		    'tableText' => [
		        'size' => 12,
		    ],
		    'tableStyle' => [				
		        'borderSize' => 6, 
		        'cellMargin' => 70, 
		        'alignment' => JcTable::CENTER, 
		        'cellSpacing' => 50
		    ],
		    'tableFirstRow' => [
		    ],
		    'headerCell' => [
		        'valign' => 'center',
		    ],
		    'cell' => [
		    ],
		    'tableFooterText' => [
		        'size' => 12,
		        'bold' => true,
		    ],
		];
		$this->document->addTableStyle(
			$this->styles['tableStyleName'], 
			$this->styles['tableStyle'], 
			$this->styles['tableFirstRow']
		);
	}

	private function buildHeader()
	{
		foreach ($this->documentInfoDto->headerStrings as $string) {
			$this->section->addText($string, $this->styles['headerStyles'], 'alignCenter');
		}
		$this->section->addTextBreak(1);
	}

	private function buildTable()
	{
		$this->table = $this->section->addTable($this->styles['tableStyleName']);

		$this->buildTableHeader();
		$this->buildTableBody();
		$this->buildTableFooter();
	}

	private function buildTableHeader()
	{
		$this->table->addRow();
		$cell = $this->table->addCell(700, $this->styles['headerCell']);
		$cell->addText('№', $this->styles['tableText'], 'alignCenter');
		$cell->addText('п/п', $this->styles['tableText'], 'alignCenter');

		$cell = $this->table->addCell(6500, $this->styles['headerCell']);
		$cell->addText('Виды работ', $this->styles['tableText'], 'alignCenter');

		$cell = $this->table->addCell(900, $this->styles['headerCell']);
		$cell->addText('За рубежом', $this->styles['tableText'], 'alignCenter');
		
		$cell = $this->table->addCell(900, $this->styles['headerCell']);
		$cell->addText('В Республике Беларусь', $this->styles['tableText'], 'alignCenter');
		
		$cell = $this->table->addCell(900, $this->styles['headerCell']);
		$cell->addText('В Бресте, В БрГУ', $this->styles['tableText'], 'alignCenter');
	}

	private function buildTableBody()
	{
		foreach ($this->documentInfoDto->workReportsGrouppedByTypeId as $typeId => $workReports) {
			$this->table->addRow();
			$this->fillBodyRow($typeId, $workReports);
		}
	}

	private function fillBodyRow($typeId, $workReports)
	{
		$typeIdCell = $this->table->addCell(style: $this->styles['cell']);
		$typeIdCell->addText($typeId, $this->styles['tableText'], 'alignRight');

		$descriptionCell = $this->table->addCell(style: $this->styles['cell']);

		$foreignPointCell = $this->table->addCell(style: array_merge(
			$this->styles['cell'], )
		);
		$belarusPointCell = $this->table->addCell(style: $this->styles['cell']);
		$brestPointCell = $this->table->addCell(style: $this->styles['cell']);

		foreach ($workReports as $workReportDto) {
			$descriptionCell->addText($workReportDto->description, $this->styles['tableText']);

			$pointCellVarName = "{$workReportDto->level}PointCell";
			$$pointCellVarName->addText($workReportDto->points, $this->styles['tableText'], 'alignCenter');
			$$pointCellVarName->addTextBreak($workReportDto->textBreaksAmount);
		}
	}

	private function buildTableFooter()
	{
		$this->table->addRow();
		$cell = $this->table->addCell(style: array_merge(
			$this->styles['cell'], 
			['gridSpan' => 5]
		));

		$text = \Yii::t(
    		'app',
    		'Итого: {n, plural, =0{нет баллов} one{# балл} few{# балла} many{# баллов} other{# балла}}', 
			['n' => $this->documentInfoDto->totalPoints]
		);
		$cell->addText($text, $this->styles['tableFooterText'], 'alignCenter');
	}
}
