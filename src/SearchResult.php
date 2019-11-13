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
     */
    public function setCode(?int $code): void
    {
        $this->code = $code;
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
     */
    public function setNumberMin(?int $numberMin): void
    {
        $this->numberMin = $numberMin;
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
     */
    public function setNumberMax(?int $numberMax): void
    {
        $this->numberMax = $numberMax;
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
     */
    public function setRegionId(?int $regionId): void
    {
        $this->regionId = $regionId;
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
     */
    public function setOperatorId(?int $operatorId): void
    {
        $this->operatorId = $operatorId;
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
     */
    public function setOperatorName(?string $operatorName): void
    {
        $this->operatorName = $operatorName;
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
     */
    public function setRegion(?RegionResult $region): void
    {
        $this->region = $region;
    }
}