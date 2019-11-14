<?php


namespace PhoneLib;


/**
 * Class SearchResult
 * @package PhoneLib
 */
class SearchResult
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string|null
     */
    private $err;

    /**
     * @var string
     */
    private $number;

    /**
     * @var int
     */
    private $countryCode;

    /**
     * @var string|null
     */
    private $nationalFormat;

    /**
     * @var string|null
     */
    private $internationalFormat;

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
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int|null $code
     * @return SearchResult
     */
    public function setCode(int $code): SearchResult
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
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return SearchResult
     */
    public function setNumber(string $number): SearchResult
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return int
     */
    public function getCountryCode(): int
    {
        return $this->countryCode;
    }

    /**
     * @param int $countryCode
     * @return SearchResult
     */
    public function setCountryCode(int $countryCode): SearchResult
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationalFormat(): ?string
    {
        return $this->nationalFormat;
    }

    /**
     * @param string|null $nationalFormat
     * @return SearchResult
     */
    public function setNationalFormat(?string $nationalFormat): SearchResult
    {
        $this->nationalFormat = $nationalFormat;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInternationalFormat(): ?string
    {
        return $this->internationalFormat;
    }

    /**
     * @param string|null $internationalFormat
     * @return SearchResult
     */
    public function setInternationalFormat(?string $internationalFormat): SearchResult
    {
        $this->internationalFormat = $internationalFormat;

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