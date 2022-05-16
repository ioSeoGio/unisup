<?php

class EducationalWorkCest
{
    public function _before(ApiTester $I)
    {
        $I->haveFixtures([
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php'
            ],
            'teachers' => [
                'class' => \tests\fixtures\TeacherFixture::class,
                'dataFile' => codecept_data_dir() . 'teachers.php'
            ],
        ]);
    }

    // public function testSuccessGenerateDocument(ApiTester $I)
    // {
    //     $I->sendPostAsJson('/documentBuilder/site/educational-work', [
    //         'teacher_id' => '1',
    //         'document_header' => 'Test Document Header',
    //     ]);

    //     $I->seeResponseCodeIsSuccessful();
    //     $I->haveHttpHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    //     $I->haveHttpHeader('Content-Description', 'File Transfer');
    //     $I->haveHttpHeader('Content-Disposition', 'attachment; filename="123.docx"');
    // }
}
