<?php


namespace PhoneLib;

/**
 * Class RegionResult
 * @package PhoneLib
 */
class RegionResult
{
    /**
     * @var string|null
     */
    private $country;
    /**
     * @var string|null
     */
    private $countryIsoCode;
    /**
     * @var string|null
     */
    private $federalDistrict;
    /**
     * @var string|null
     */
    private $fiasCode;
    /**
     * @var int|null
     */
    private $fiasLevel;
    /**
     * @var int|null
     */
    private $geoLat;
    /**
     * @var int|null
     */
    private $geoLon;
    /**
     * @var int|null
     */
    private $kladrId;
    /**
     * @var int|null
     */
    private $okato;
    /**
     * @var int|null
     */
    private $oktmo;
    /**
     * @var int|null
     */
    private $postalCode;
    /**
     * @var string|null
     */
    private $regionName;
    /**
     * @var string|null uuid
     */
    private $regionFiasId;
    /**
     * @var string|null
     */
    private $regionIsoCode;
    /**
     * @var int|null
     */
    private $regionKladrId;
    /**
     * @var string|null
     */
    private $regionType;
    /**
     * @var string|null
     */
    private $result;
    /**
     * @var string|null
     */
    private $timezone;
    /**
     * @var int|null
     */
    private $updated;

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return RegionResult
     */
    public function setCountry(?string $country): RegionResult
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryIsoCode(): ?string
    {
        return $this->countryIsoCode;
    }

    /**
     * @param string|null $countryIsoCode
     * @return RegionResult
     */
    public function setCountryIsoCode(?string $countryIsoCode): RegionResult
    {
        $this->countryIsoCode = $countryIsoCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFederalDistrict(): ?string
    {
        return $this->federalDistrict;
    }

    /**
     * @param string|null $federalDistrict
     * @return RegionResult
     */
    public function setFederalDistrict(?string $federalDistrict): RegionResult
    {
        $this->federalDistrict = $federalDistrict;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFiasCode(): ?string
    {
        return $this->fiasCode;
    }

    /**
     * @param string|null $fiasCode
     * @return RegionResult
     */
    public function setFiasCode(?string $fiasCode): RegionResult
    {
        $this->fiasCode = $fiasCode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFiasLevel(): ?int
    {
        return $this->fiasLevel;
    }

    /**
     * @param int|null $fiasLevel
     * @return RegionResult
     */
    public function setFiasLevel(?int $fiasLevel): RegionResult
    {
        $this->fiasLevel = $fiasLevel;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGeoLat(): ?int
    {
        return $this->geoLat;
    }

    /**
     * @param int|null $geoLat
     * @return RegionResult
     */
    public function setGeoLat(?int $geoLat): RegionResult
    {
        $this->geoLat = $geoLat;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGeoLon(): ?int
    {
        return $this->geoLon;
    }

    /**
     * @param int|null $geoLon
     * @return RegionResult
     */
    public function setGeoLon(?int $geoLon): RegionResult
    {
        $this->geoLon = $geoLon;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getKladrId(): ?int
    {
        return $this->kladrId;
    }

    /**
     * @param int|null $kladrId
     * @return RegionResult
     */
    public function setKladrId(?int $kladrId): RegionResult
    {
        $this->kladrId = $kladrId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOkato(): ?int
    {
        return $this->okato;
    }

    /**
     * @param int|null $okato
     * @return RegionResult
     */
    public function setOkato(?int $okato): RegionResult
    {
        $this->okato = $okato;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOktmo(): ?int
    {
        return $this->oktmo;
    }

    /**
     * @param int|null $oktmo
     * @return RegionResult
     */
    public function setOktmo(?int $oktmo): RegionResult
    {
        $this->oktmo = $oktmo;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int|null $postalCode
     * @return RegionResult
     */
    public function setPostalCode(?int $postalCode): RegionResult
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    /**
     * @param string|null $regionName
     * @return RegionResult
     */
    public function setRegionName(?string $regionName): RegionResult
    {
        $this->regionName = $regionName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegionFiasId(): ?string
    {
        return $this->regionFiasId;
    }

    /**
     * @param string|null $regionFiasId
     * @return RegionResult
     */
    public function setRegionFiasId(?string $regionFiasId): RegionResult
    {
        $this->regionFiasId = $regionFiasId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegionIsoCode(): ?string
    {
        return $this->regionIsoCode;
    }

    /**
     * @param string|null $regionIsoCode
     * @return RegionResult
     */
    public function setRegionIsoCode(?string $regionIsoCode): RegionResult
    {
        $this->regionIsoCode = $regionIsoCode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRegionKladrId(): ?int
    {
        return $this->regionKladrId;
    }

    /**
     * @param int|null $regionKladrId
     * @return RegionResult
     */
    public function setRegionKladrId(?int $regionKladrId): RegionResult
    {
        $this->regionKladrId = $regionKladrId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegionType(): ?string
    {
        return $this->regionType;
    }

    /**
     * @param string|null $regionType
     * @return RegionResult
     */
    public function setRegionType(?string $regionType): RegionResult
    {
        $this->regionType = $regionType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResult(): ?string
    {
        return $this->result;
    }

    /**
     * @param string|null $result
     * @return RegionResult
     */
    public function setResult(?string $result): RegionResult
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * @param string|null $timezone
     * @return RegionResult
     */
    public function setTimezone(?string $timezone): RegionResult
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    /**
     * @param int|null $updated
     * @return RegionResult
     */
    public function setUpdated(?int $updated): RegionResult
    {
        $this->updated = $updated;

        return $this;
    }
}