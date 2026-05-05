<?php
namespace Kunnu\Dropbox\Models;

class ThumbnailBatchResult extends BaseModel
{
    /**
     * List of Thumbnail Batch Result Entries
     *
     * @var \Kunnu\Dropbox\Models\ModelCollection
     */
    protected $entries = null;

    /**
     * Create a new ThumbnailBatchResult instance
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $entries = isset($data['entries']) ? $data['entries'] : [];
        $this->processEntries($entries);
    }

    /**
     * Process entries and cast them
     * to ThumbnailBatchResultEntry Model
     *
     * @param array $entries Unprocessed Entries
     *
     * @return void
     */
    protected function processEntries(array $entries)
    {
        $processedEntries = [];

        foreach ($entries as $entry) {
            $processedEntries[] = new ThumbnailBatchResultEntry($entry);
        }

        $this->entries = new ModelCollection($processedEntries);
    }

    /**
     * Get the entries
     *
     * @return \Kunnu\Dropbox\Models\ModelCollection
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
