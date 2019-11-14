<?php


namespace PhoneLib;


/**
 * Class SearchResult
 * @package PhoneLib
 */
class SearchResult
{
    /**
     * @var int|null
     */
    private $code;

    /**
     * @var string|null
     */
    private $err;

    /**
     * @var int|null
     */
    private $numberMin;
    /**
     * @var int|null
     */
    private $numberMax;
    /**
     * @var int|null
     */
    private $regionId;
    /**
     * @var int|null
     */
    private $operatorId;
    /**
     * @var string|null
     */
    private $operatorName;
    /**
     * @var RegionResult|null
     */
    private $region;

    /**
     * @return int|null
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     * @param int|null $code
     * @return SearchResult
     */
    public function setCode(?int $code): SearchResult
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getErr(): ?string
    {
        return $this->err;
    }

    /**
     * @param string|null $err
     * @return SearchResult
     */
    public function setErr(?string $err): SearchResult
    {
        $this->err = $err;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberMin(): ?int
    {
        return $this->numberMin;
    }

    /**
     * @param int|null $numberMin
     * @return SearchResult
     */
    public function setNumberMin(?int $numberMin): SearchResult
    {
        $this->numberMin = $numberMin;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberMax(): ?int
    {
        return $this->numberMax;
    }

    /**
     * @param int|null $numberMax
     * @return SearchResult
     */
    public function setNumberMax(?int $numberMax): SearchResult
    {
        $this->numberMax = $numberMax;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRegionId(): ?int
    {
        return $this->regionId;
    }

    /**
     * @param int|null $regionId
     * @return SearchResult
     */
    public function setRegionId(?int $regionId): SearchResult
    {
        $this->regionId = $regionId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOperatorId(): ?int
    {
        return $this->operatorId;
    }

    /**
     * @param int|null $operatorId
     * @return SearchResult
     */
    public function setOperatorId(?int $operatorId): SearchResult
    {
        $this->operatorId = $operatorId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOperatorName(): ?string
    {
        return $this->operatorName;
    }

    /**
     * @param string|null $operatorName
     * @return SearchResult
     */
    public function setOperatorName(?string $operatorName): SearchResult
    {
        $this->operatorName = $operatorName;

        return $this;
    }

    /**
     * @return RegionResult|null
     */
    public function getRegion(): ?RegionResult
    {
        return $this->region;
    }

    /**
     * @param RegionResult|null $region
     * @return SearchResult
     */
    public function setRegion(?RegionResult $region): SearchResult
    {
        $this->region = $region;

        return $this;
    }
}