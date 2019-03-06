<?php

namespace link\hefang\helpers;


use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    public function testHump2underLine()
    {
        $data = [
            'article' => 'article',
            'ARTICLE' => 'a_r_t_i_c_l_e',
            'English和中文混合的string' => 'english和中文混合的string',
            'ViewArticleModel' => 'view_article_model'
        ];
        foreach ($data as $input => $output) {
            self::assertEquals(StringHelper::hump2underLine($input), $output);
        }
    }

    public function testUnderLine2hump()
    {
        $upperFirstCharData = [
            'article' => 'Article',
            'a_r_t_i_c_l_e' => 'ARTICLE',
            'english和中文混合的string' => 'English和中文混合的string',
            'view_article_model' => 'ViewArticleModel',
            '_start_with_under_line' => 'StartWithUnderLine'
        ];
        $data = [
            'article' => 'article',
            'a_r_t_i_c_l_e' => 'aRTICLE',
            'english和中文混合的string' => 'english和中文混合的string',
            'view_article_model' => 'viewArticleModel',
            '_start_with_under_line' => 'startWithUnderLine'
        ];
        foreach ($upperFirstCharData as $input => $output) {
            self::assertEquals(StringHelper::underLine2hump($input), $output);
        }
        foreach ($data as $input => $output) {
            self::assertEquals(StringHelper::underLine2hump($input, false), $output);
        }
    }

    public function testContains()
    {
        self::assertTrue(StringHelper::contains("I am hefang!", false, 'I', ' '));
        self::assertFalse(StringHelper::contains("I am hefang!", false, 'H', 'Am'));
        self::assertTrue(StringHelper::contains("I am hefang!", true, 'i', ' '));
        self::assertTrue(StringHelper::contains("I am hefang!", true, ['H', 'Am']));
        self::assertTrue(StringHelper::contains("English和中文", true, ['中', 'English']));
    }

    public function testEndsWith()
    {
        self::assertTrue(StringHelper::endsWith("空格结尾 ", true, ' '));
        self::assertTrue(StringHelper::endsWith("中文English混合结Ends尾", true, '结ENDS尾'));
        self::assertTrue(StringHelper::endsWith("中文English And 空格混合结 Ends 尾", false, '结 Ends 尾'));
        self::assertTrue(StringHelper::endsWith("中文English And 空格 符号混合结&^%#$%Ends 尾", true, '结&^%#$%Ends 尾'));
    }

    public function testStartsWith()
    {
        self::assertTrue(StringHelper::startsWith(" 空格开头", true, ' '));
        self::assertTrue(StringHelper::startsWith("中文English混合开头", true, '中文English'));
        self::assertTrue(StringHelper::startsWith("中文 English And 空格混合开头", true, '中文 English'));
        self::assertTrue(StringHelper::startsWith("中文)*(&^#$%^&*(English And 空格 符号混合开头", true, '中文)*(&^#$%^&*(English'));
    }

    public function testIsNullOrBlank()
    {
        $data = [
            null => true,
            '' => true,
            '    ' => true,
            'sd' => false,
            "\n" => true,
            "\t" => true,
            "\0" => true,
            1 => false,
            true => false,
            false => false
        ];
        foreach ($data as $i => $o) {
            self::assertEquals(StringHelper::isNullOrBlank($i), $o);
        }
    }

    public function testIsNullOrEmpty()
    {
        $data = [
            null => true,
            '' => true,
            '    ' => false,
            'sd' => false,
            "\n" => false,
            "\t" => false,
            "\0" => false,
            1 => false,
            true => false,
            false => false
        ];
        foreach ($data as $i => $o) {
            self::assertEquals(StringHelper::isNullOrEmpty($i), $o);
        }
    }

    public function testShortStr()
    {
        self::assertEquals(StringHelper::shortStr(
            "这是一段中文和English混合的长度超过20的字符串", 20, false
        ), "这是一段中文和English混合的长度超");
        self::assertEquals(StringHelper::shortStr(
            "这是一段中文和English混合的长度超过20的字符串", 20, true
        ), "这是一段中文和English混合的...");
    }

    public function testQueryString()
    {
        $data = [
            'a' => 'avalue',
            'b' => 'https://hefang.link',
            'c' => '中文',
            'd' => '',
            'e' => null
        ];
        self::assertEquals(
            StringHelper::queryString($data, false, false, false),
            'a=avalue&b=https://hefang.link&c=中文&d=&e='
        );
        self::assertEquals(
            StringHelper::queryString($data, false, true, false),
            'a=avalue&b=https://hefang.link&c=中文&d='
        );
        self::assertEquals(
            StringHelper::queryString($data, false, false, true),
            'a=avalue&b=https://hefang.link&c=中文'
        );
        self::assertEquals(
            StringHelper::queryString($data, false, true, true),
            'a=avalue&b=https://hefang.link&c=中文'
        );
        self::assertEquals(
            StringHelper::queryString($data, true, false, false),
            'a=avalue&b=' . urlencode('https://hefang.link') . '&c=' . urlencode('中文') . '&d=&e='
        );
        self::assertEquals(
            StringHelper::queryString($data, true, true, true),
            'a=avalue&b=' . urlencode('https://hefang.link') . '&c=' . urlencode('中文')
        );
    }

    public function testContact()
    {
        self::assertEquals(
            StringHelper::contact([1, 2, 3, true, false, 3.5, 'english', '中文', '中文和English', '#$$%$##@$%']),
            "12313.5english中文中文和English#$$%$##@$%"
        );
        self::assertEquals(
            StringHelper::contact(1, 2, 3, true, false, 3.5, 'english', '中文', '中文和English', '#$$%$##@$%'),
            "12313.5english中文中文和English#$$%$##@$%"
        );
    }
}