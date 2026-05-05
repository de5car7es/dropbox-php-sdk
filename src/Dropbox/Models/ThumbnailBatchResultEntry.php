<?php
namespace Kunnu\Dropbox\Models;

class ThumbnailBatchResultEntry extends BaseModel
{
    /**
     * File Metadata (if success)
     *
     * @var \Kunnu\Dropbox\Models\FileMetadata
     */
    protected $metadata = null;

    /**
     * Thumbnail Data (if success)
     *
     * @var string
     */
    protected $thumbnail = null;

    /**
     * Error tag (if failure)
     *
     * @var string
     */
    protected $error = null;

    /**
     * Create a new ThumbnailBatchResultEntry instance
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($this->isSuccess()) {
            $this->metadata = new FileMetadata($this->getDataProperty('metadata'));
            $this->thumbnail = $this->getDataProperty('thumbnail');
        } else {
            $this->error = $this->getDataProperty('failure');
        }
    }

    /**
     * Check if the entry is a success
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getDataProperty('.tag') === 'success';
    }

    /**
     * Get the metadata
     *
     * @return \Kunnu\Dropbox\Models\FileMetadata|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Get the thumbnail data
     *
     * @return string|null
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Get the error
     *
     * @return mixed|null
     */
    public function getError()
    {
        return $this->error;
    }
}
