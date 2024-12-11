<?php
/*
 * Copyright 2024 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * Generated by gapic-generator-php from the file
 * https://github.com/googleapis/googleapis/blob/master/google/api/serviceusage/v1/serviceusage.proto
 * Updates to the above are reflected here through a refresh process.
 */

namespace Google\Cloud\ServiceUsage\V1\Client;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\OperationResponse;
use Google\ApiCore\PagedListResponse;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\ServiceUsage\V1\BatchEnableServicesRequest;
use Google\Cloud\ServiceUsage\V1\BatchGetServicesRequest;
use Google\Cloud\ServiceUsage\V1\BatchGetServicesResponse;
use Google\Cloud\ServiceUsage\V1\DisableServiceRequest;
use Google\Cloud\ServiceUsage\V1\EnableServiceRequest;
use Google\Cloud\ServiceUsage\V1\GetServiceRequest;
use Google\Cloud\ServiceUsage\V1\ListServicesRequest;
use Google\Cloud\ServiceUsage\V1\Service;
use Google\LongRunning\Client\OperationsClient;
use Google\LongRunning\Operation;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Log\LoggerInterface;

/**
 * Service Description: Enables services that service consumers want to use on Google Cloud Platform,
 * lists the available or enabled services, or disables services that service
 * consumers no longer use.
 *
 * See [Service Usage API](https://cloud.google.com/service-usage/docs/overview)
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods.
 *
 * @method PromiseInterface<OperationResponse> batchEnableServicesAsync(BatchEnableServicesRequest $request, array $optionalArgs = [])
 * @method PromiseInterface<BatchGetServicesResponse> batchGetServicesAsync(BatchGetServicesRequest $request, array $optionalArgs = [])
 * @method PromiseInterface<OperationResponse> disableServiceAsync(DisableServiceRequest $request, array $optionalArgs = [])
 * @method PromiseInterface<OperationResponse> enableServiceAsync(EnableServiceRequest $request, array $optionalArgs = [])
 * @method PromiseInterface<Service> getServiceAsync(GetServiceRequest $request, array $optionalArgs = [])
 * @method PromiseInterface<PagedListResponse> listServicesAsync(ListServicesRequest $request, array $optionalArgs = [])
 */
final class ServiceUsageClient
{
    use GapicClientTrait;

    /** The name of the service. */
    private const SERVICE_NAME = 'google.api.serviceusage.v1.ServiceUsage';

    /**
     * The default address of the service.
     *
     * @deprecated SERVICE_ADDRESS_TEMPLATE should be used instead.
     */
    private const SERVICE_ADDRESS = 'serviceusage.googleapis.com';

    /** The address template of the service. */
    private const SERVICE_ADDRESS_TEMPLATE = 'serviceusage.UNIVERSE_DOMAIN';

    /** The default port of the service. */
    private const DEFAULT_SERVICE_PORT = 443;

    /** The name of the code generator, to be included in the agent header. */
    private const CODEGEN_NAME = 'gapic';

    /** The default scopes required by the service. */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
        'https://www.googleapis.com/auth/cloud-platform.read-only',
        'https://www.googleapis.com/auth/service.management',
    ];

    private $operationsClient;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'apiEndpoint' => self::SERVICE_ADDRESS . ':' . self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__ . '/../resources/service_usage_client_config.json',
            'descriptorsConfigPath' => __DIR__ . '/../resources/service_usage_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__ . '/../resources/service_usage_grpc_config.json',
            'credentialsConfig' => [
                'defaultScopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__ . '/../resources/service_usage_rest_client_config.php',
                ],
            ],
        ];
    }

    /**
     * Return an OperationsClient object with the same endpoint as $this.
     *
     * @return OperationsClient
     */
    public function getOperationsClient()
    {
        return $this->operationsClient;
    }

    /**
     * Resume an existing long running operation that was previously started by a long
     * running API method. If $methodName is not provided, or does not match a long
     * running API method, then the operation can still be resumed, but the
     * OperationResponse object will not deserialize the final response.
     *
     * @param string $operationName The name of the long running operation
     * @param string $methodName    The name of the method used to start the operation
     *
     * @return OperationResponse
     */
    public function resumeOperation($operationName, $methodName = null)
    {
        $options = isset($this->descriptors[$methodName]['longRunning'])
            ? $this->descriptors[$methodName]['longRunning']
            : [];
        $operation = new OperationResponse($operationName, $this->getOperationsClient(), $options);
        $operation->reload();
        return $operation;
    }

    /**
     * Create the default operation client for the service.
     *
     * @param array $options ClientOptions for the client.
     *
     * @return OperationsClient
     */
    private function createOperationsClient(array $options)
    {
        // Unset client-specific configuration options
        unset($options['serviceName'], $options['clientConfig'], $options['descriptorsConfigPath']);

        if (isset($options['operationsClient'])) {
            return $options['operationsClient'];
        }

        return new OperationsClient($options);
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *     Optional. Options for configuring the service API wrapper.
     *
     *     @type string $apiEndpoint
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'serviceusage.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the
     *           client. For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()} .
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either
     *           a path to a JSON file, or a PHP array containing the decoded JSON data. By
     *           default this settings points to the default client config file, which is
     *           provided in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string
     *           `rest` or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already
     *           instantiated {@see \Google\ApiCore\Transport\TransportInterface} object. Note
     *           that when this object is provided, any settings in $transportConfig, and any
     *           $apiEndpoint setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...],
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     *     @type callable $clientCertSource
     *           A callable which returns the client cert as a string. This can be used to
     *           provide a certificate and private key to the transport layer for mTLS.
     *     @type false|LoggerInterface $logger
     *           A PSR-3 compliant logger. If set to false, logging is disabled, ignoring the
     *           'GOOGLE_SDK_PHP_LOGGING' environment flag
     * }
     *
     * @throws ValidationException
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
        $this->operationsClient = $this->createOperationsClient($clientOptions);
    }

    /** Handles execution of the async variants for each documented method. */
    public function __call($method, $args)
    {
        if (substr($method, -5) !== 'Async') {
            trigger_error('Call to undefined method ' . __CLASS__ . "::$method()", E_USER_ERROR);
        }

        array_unshift($args, substr($method, 0, -5));
        return call_user_func_array([$this, 'startAsyncCall'], $args);
    }

    /**
     * Enable multiple services on a project. The operation is atomic: if enabling
     * any service fails, then the entire batch fails, and no state changes occur.
     * To enable a single service, use the `EnableService` method instead.
     *
     * The async variant is {@see ServiceUsageClient::batchEnableServicesAsync()} .
     *
     * @example samples/V1/ServiceUsageClient/batch_enable_services.php
     *
     * @param BatchEnableServicesRequest $request     A request to house fields associated with the call.
     * @param array                      $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function batchEnableServices(BatchEnableServicesRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('BatchEnableServices', $request, $callOptions)->wait();
    }

    /**
     * Returns the service configurations and enabled states for a given list of
     * services.
     *
     * The async variant is {@see ServiceUsageClient::batchGetServicesAsync()} .
     *
     * @example samples/V1/ServiceUsageClient/batch_get_services.php
     *
     * @param BatchGetServicesRequest $request     A request to house fields associated with the call.
     * @param array                   $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return BatchGetServicesResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function batchGetServices(
        BatchGetServicesRequest $request,
        array $callOptions = []
    ): BatchGetServicesResponse {
        return $this->startApiCall('BatchGetServices', $request, $callOptions)->wait();
    }

    /**
     * Disable a service so that it can no longer be used with a project.
     * This prevents unintended usage that may cause unexpected billing
     * charges or security leaks.
     *
     * It is not valid to call the disable method on a service that is not
     * currently enabled. Callers will receive a `FAILED_PRECONDITION` status if
     * the target service is not currently enabled.
     *
     * The async variant is {@see ServiceUsageClient::disableServiceAsync()} .
     *
     * @example samples/V1/ServiceUsageClient/disable_service.php
     *
     * @param DisableServiceRequest $request     A request to house fields associated with the call.
     * @param array                 $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function disableService(DisableServiceRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('DisableService', $request, $callOptions)->wait();
    }

    /**
     * Enable a service so that it can be used with a project.
     *
     * The async variant is {@see ServiceUsageClient::enableServiceAsync()} .
     *
     * @example samples/V1/ServiceUsageClient/enable_service.php
     *
     * @param EnableServiceRequest $request     A request to house fields associated with the call.
     * @param array                $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return OperationResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function enableService(EnableServiceRequest $request, array $callOptions = []): OperationResponse
    {
        return $this->startApiCall('EnableService', $request, $callOptions)->wait();
    }

    /**
     * Returns the service configuration and enabled state for a given service.
     *
     * The async variant is {@see ServiceUsageClient::getServiceAsync()} .
     *
     * @example samples/V1/ServiceUsageClient/get_service.php
     *
     * @param GetServiceRequest $request     A request to house fields associated with the call.
     * @param array             $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return Service
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function getService(GetServiceRequest $request, array $callOptions = []): Service
    {
        return $this->startApiCall('GetService', $request, $callOptions)->wait();
    }

    /**
     * List all services available to the specified project, and the current
     * state of those services with respect to the project. The list includes
     * all public services, all services for which the calling user has the
     * `servicemanagement.services.bind` permission, and all services that have
     * already been enabled on the project. The list can be filtered to
     * only include services in a specific state, for example to only include
     * services enabled on the project.
     *
     * WARNING: If you need to query enabled services frequently or across
     * an organization, you should use
     * [Cloud Asset Inventory
     * API](https://cloud.google.com/asset-inventory/docs/apis), which provides
     * higher throughput and richer filtering capability.
     *
     * The async variant is {@see ServiceUsageClient::listServicesAsync()} .
     *
     * @example samples/V1/ServiceUsageClient/list_services.php
     *
     * @param ListServicesRequest $request     A request to house fields associated with the call.
     * @param array               $callOptions {
     *     Optional.
     *
     *     @type RetrySettings|array $retrySettings
     *           Retry settings to use for this call. Can be a {@see RetrySettings} object, or an
     *           associative array of retry settings parameters. See the documentation on
     *           {@see RetrySettings} for example usage.
     * }
     *
     * @return PagedListResponse
     *
     * @throws ApiException Thrown if the API call fails.
     */
    public function listServices(ListServicesRequest $request, array $callOptions = []): PagedListResponse
    {
        return $this->startApiCall('ListServices', $request, $callOptions);
    }
}
