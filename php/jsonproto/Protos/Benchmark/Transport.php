<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# NO CHECKED-IN PROTOBUF GENCODE
# source: benchmark.proto

namespace Benchmark;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>benchmark.Transport</code>
 */
class Transport extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string id = 1;</code>
     */
    protected $id = '';
    /**
     * Generated from protobuf field <code>string code = 2;</code>
     */
    protected $code = '';
    /**
     * Generated from protobuf field <code>string externalId = 3;</code>
     */
    protected $externalId = '';
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedStartAt = 4;</code>
     */
    protected $plannedStartAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedEndAt = 5;</code>
     */
    protected $plannedEndAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualStartAt = 6;</code>
     */
    protected $actualStartAt = null;
    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualEndAt = 7;</code>
     */
    protected $actualEndAt = null;
    /**
     * Generated from protobuf field <code>double cost = 8;</code>
     */
    protected $cost = 0.0;
    /**
     * Generated from protobuf field <code>double travelTime = 9;</code>
     */
    protected $travelTime = 0.0;
    /**
     * Generated from protobuf field <code>repeated .benchmark.Package packages = 10;</code>
     */
    private $packages;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $id
     *     @type string $code
     *     @type string $externalId
     *     @type \Google\Protobuf\Timestamp $plannedStartAt
     *     @type \Google\Protobuf\Timestamp $plannedEndAt
     *     @type \Google\Protobuf\Timestamp $actualStartAt
     *     @type \Google\Protobuf\Timestamp $actualEndAt
     *     @type float $cost
     *     @type float $travelTime
     *     @type array<\Benchmark\Package>|\Google\Protobuf\Internal\RepeatedField $packages
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Benchmark::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generated from protobuf field <code>string id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string code = 2;</code>
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Generated from protobuf field <code>string code = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->code = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string externalId = 3;</code>
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * Generated from protobuf field <code>string externalId = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setExternalId($var)
    {
        GPBUtil::checkString($var, True);
        $this->externalId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedStartAt = 4;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getPlannedStartAt()
    {
        return $this->plannedStartAt;
    }

    public function hasPlannedStartAt()
    {
        return isset($this->plannedStartAt);
    }

    public function clearPlannedStartAt()
    {
        unset($this->plannedStartAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedStartAt = 4;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setPlannedStartAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->plannedStartAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedEndAt = 5;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getPlannedEndAt()
    {
        return $this->plannedEndAt;
    }

    public function hasPlannedEndAt()
    {
        return isset($this->plannedEndAt);
    }

    public function clearPlannedEndAt()
    {
        unset($this->plannedEndAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp plannedEndAt = 5;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setPlannedEndAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->plannedEndAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualStartAt = 6;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getActualStartAt()
    {
        return $this->actualStartAt;
    }

    public function hasActualStartAt()
    {
        return isset($this->actualStartAt);
    }

    public function clearActualStartAt()
    {
        unset($this->actualStartAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualStartAt = 6;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setActualStartAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->actualStartAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualEndAt = 7;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getActualEndAt()
    {
        return $this->actualEndAt;
    }

    public function hasActualEndAt()
    {
        return isset($this->actualEndAt);
    }

    public function clearActualEndAt()
    {
        unset($this->actualEndAt);
    }

    /**
     * Generated from protobuf field <code>.google.protobuf.Timestamp actualEndAt = 7;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setActualEndAt($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->actualEndAt = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>double cost = 8;</code>
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Generated from protobuf field <code>double cost = 8;</code>
     * @param float $var
     * @return $this
     */
    public function setCost($var)
    {
        GPBUtil::checkDouble($var);
        $this->cost = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>double travelTime = 9;</code>
     * @return float
     */
    public function getTravelTime()
    {
        return $this->travelTime;
    }

    /**
     * Generated from protobuf field <code>double travelTime = 9;</code>
     * @param float $var
     * @return $this
     */
    public function setTravelTime($var)
    {
        GPBUtil::checkDouble($var);
        $this->travelTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .benchmark.Package packages = 10;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPackages()
    {
        return $this->packages;
    }

    /**
     * Generated from protobuf field <code>repeated .benchmark.Package packages = 10;</code>
     * @param array<\Benchmark\Package>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPackages($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Benchmark\Package::class);
        $this->packages = $arr;

        return $this;
    }

}

