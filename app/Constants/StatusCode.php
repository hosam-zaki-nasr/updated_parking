<?php

namespace App\Constants;

class StatusCode
{
    public const OK = 200;  //OK
    public const CREATED = 201; //Created
    public const ACCEPTED = 202;    //Accepted
    public const NON_AUTHORITATIVE_INFORMATION = 203;   //Non-Authoritative Information
    public const NO_CONTENT = 204;  //No Content
    public const RESET_CONTENT = 205;   //Reset Content
    public const PARTIAL_CONTENT = 206; //Partial Content
    public const MULTI_STATUS = 207;    //Multi-Status
    public const MULTIPLE_CHOICES = 300;    //Multiple Choices
    public const MOVED_PERMANENTLY = 301;   //Moved Permanently
    public const MOVED_TEMPORARILY = 302;   //Moved Temporarily
    public const SEE_OTHER = 303;   //See Other
    public const NOT_MODIFIED = 304;    //Not Modified
    public const USE_PROXY = 305;   //Use Proxy
    public const TEMPORARY_REDIRECT = 307;  //Temporary Redirect
    public const PERMANENT_REDIRECT = 308;  //Permanent Redirect
    public const BAD_REQUEST = 400; //Bad Request
    public const UNAUTHORIZED = 401;    //Unauthorized
    public const PAYMENT_REQUIRED = 402;    //Payment Required
    public const FORBIDDEN = 403;   //Forbidden
    public const NOT_FOUND = 404;   //Not Found
    public const METHOD_NOT_ALLOWED = 405;  //Method Not Allowed
    public const NOT_ACCEPTABLE = 406;  //Not Acceptable
    public const PROXY_AUTHENTICATION_REQUIRED = 407;   //Proxy Authentication Required
    public const REQUEST_TIMEOUT = 408; //Request Timeout
    public const CONFLICT = 409;    //Conflict
    public const GONE = 410;    //Gone
    public const LENGTH_REQUIRED = 411; //Length Required
    public const PRECONDITION_FAILED = 412; //Precondition Failed
    public const REQUEST_TOO_LONG = 413;    //Request Entity Too Large
    public const REQUEST_URI_TOO_LONG = 414;    //Request-URI Too Long
    public const UNSUPPORTED_MEDIA_TYPE = 415;  //Unsupported Media Type
    public const REQUESTED_RANGE_NOT_SATISFIABLE = 416; //Requested Range Not Satisfiable
    public const EXPECTATION_FAILED = 417;  //Expectation Failed
    public const IM_A_TEAPOT = 418; //Im a teapot
    public const INSUFFICIENT_SPACE_ON_RESOURCE = 419;  //Insufficient Space on Resource
    public const METHOD_FAILURE = 420;  //Method Failure
    public const UNPROCESSABLE_ENTITY = 422;    //Unprocessable Entity
    public const LOCKED = 423;  //Locked
    public const FAILED_DEPENDENCY = 424;   //Failed Dependency
    public const PRECONDITION_REQUIRED = 428;   //Precondition Required
    public const TOO_MANY_REQUESTS = 429;   //Too Many Requests
    public const REQUEST_HEADER_FIELDS_TOO_LARGE = 431; //Request Header Fields Too Large
    public const UNAVAILABLE_FOR_LEGAL_REASONS = 451;   //Unavailable For Legal Reasons
    public const INTERNAL_SERVER_ERROR = 500;   //Internal Server Error
    public const NOT_IMPLEMENTED = 501; //Not Implemented
    public const BAD_GATEWAY = 502; //Bad Gateway
    public const SERVICE_UNAVAILABLE = 503; //Service Unavailable
    public const GATEWAY_TIMEOUT = 504; //Gateway Timeout
    public const HTTP_VERSION_NOT_SUPPORTED = 505;  //HTTP Version Not Supported
    public const INSUFFICIENT_STORAGE = 507;    //Insufficient Storage
    public const NETWORK_AUTHENTICATION_REQUIRED = 511; //Network Authentication Required
}
