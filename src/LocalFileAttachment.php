<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE                                               |
// +---------------------------------------------------------------------+
// | Copyright (c) 2018 - Code Inc. SAS - All Rights Reserved.           |
// | Visit https://www.codeinc.fr for more information about licensing.  |
// +---------------------------------------------------------------------+
// | NOTICE:  All information contained herein is, and remains the       |
// | property of Code Inc. SAS. The intellectual and technical concepts  |
// | contained herein are proprietary to Code Inc. SAS are protected by  |
// | trade secret or copyright law. Dissemination of this information or |
// | reproduction of this material is strictly forbidden unless prior    |
// | written permission is obtained from Code Inc. SAS.                  |
// +---------------------------------------------------------------------+
//
// Author:   Joan Fabrégat <joan@codeinc.fr>
// Date:     10/08/2018
// Project:  Mailer
//
declare(strict_types=1);
namespace CodeInc\Mailer;


/**
 * Class LocalFileAttachment
 *
 * @package CodeInc\Mailer
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class LocalFileAttachment implements EmailAttachmentInterface
{
    /**
     * @var string
     */
    protected $localFilePath;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $mimeType;

    /**
     * LocalFileAttachment constructor.
     *
     * @param string $localFilePath
     * @param null|string $fileName
     * @param null|string $mimeType
     */
    public function __construct(string $localFilePath, ?string $fileName = null, ?string $mimeType = null)
    {
        $this->localFilePath = $localFilePath;
        $this->fileName = $fileName ?? basename($localFilePath);
        $this->mimeType = $mimeType ?? MediaTypes::getFilenameMediaType($localFilePath) ?? 'application/octet-stream';
    }

    /**
     * @return string
     */
    public function getFileName():string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getMimeType():string
    {
        return $this->mimeType;
    }

    /**
     * @return resource
     */
    public function getData()
    {
        $f = fopen($this->localFilePath, 'r');
        if (!$f) {
            throw new \RuntimeException(sprintf("Unable to open the local file '%s'", $this->localFilePath));
        }
        return $f;
    }
}