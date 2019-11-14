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
    public function setCode(?int $code): self
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
    public function setErr(?string $err): self
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
    public function setNumberMin(?int $numberMin): self
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
    public function setNumberMax(?int $numberMax): self
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
    public function setRegionId(?int $regionId): self
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
    public function setOperatorId(?int $operatorId): self
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
    public function setOperatorName(?string $operatorName): self
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
    public function setRegion(?RegionResult $region): self
    {
        $this->region = $region;

        return $this;
    }
}