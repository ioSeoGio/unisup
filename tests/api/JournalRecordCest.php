<?php

use tests\api\common\Cest;

class JournalRecordCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
            ],
            'teachers' => [
                'class' => \tests\fixtures\TeacherFixture::class,
            ],
            'journals' => [
                'class' => \tests\fixtures\JournalFixture::class,
            ],
            'journal_records' => [
                'class' => \tests\fixtures\JournalRecordFixture::class,
            ],
            'disciplines' => [
                'class' => \tests\fixtures\DisciplineFixture::class,
            ],
            'groups' => [
                'class' => \tests\fixtures\GroupFixture::class,
            ],
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/journal-record/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'topic' => 'Линейные уравнения1',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
              'id' => 1,
              'topic' => 'Линейные уравнения1',
            ],
        ]);
    }

    public function testReadAction(ApiTester $I)
    {
        $url = '/admin/journal-record/read?id=2';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'topic' => 'Линейные уравнения2',
            ],
        ]);
    }

    public function testCreateAction(ApiTester $I)
    {
        $url = '/admin/journal-record/create';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);
        $data = [
            'topic' => 'Линейные уравнения NEW', 
            'class_type' => 1, 
            'journal_id' => 1, 
            'teacher_id' => 1, 
            'group_id' => 1,
            'lesson_at' => '2021-12-01 21:12:03',
        ];
        $I->sendPostAsJson($url, $data);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => $data
        ]);
    }

    public function testUpdateActionOneField(ApiTester $I)
    {
        $url = '/admin/journal-record/update?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($url, ['topic' => 'test-topic-updated']);
        
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'id' => 1,
                'topic' => 'test-topic-updated',
            ]
        ]);
    }

    public function testDeleteAction(ApiTester $I)
    {
        $readUrl = '/admin/journal-record/read?id=1';
        $I->sendGetAsJson($readUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $deleteUrl = '/admin/journal-record/delete?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($deleteUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $I->sendGetAsJson($readUrl);
        $I->seeResponseCodeIs(404);
    }
}
