<?php

namespace Tests\Feature\Services;

use App\Repositories\OrganizationRepository;
use App\Services\ChallengeTransactionService;
use App\Services\TomlService;
use Illuminate\Support\Carbon;
use phpseclib\Math\BigInteger;
use Tests\TestCase;
use ZuluCrypto\StellarSdk\Horizon\ApiClient;
use ZuluCrypto\StellarSdk\Keypair;
use ZuluCrypto\StellarSdk\Transaction\Transaction;
use ZuluCrypto\StellarSdk\Transaction\TransactionBuilder;
use ZuluCrypto\StellarSdk\Xdr\XdrBuffer;
use ZuluCrypto\StellarSdk\XdrModel\TransactionEnvelope;

class ChallengeTransactionServiceTest extends TestCase
{
    /**
     * @var Keypair
     */
    protected $serverSigningKey;

    public function setUp(): void
    {
        parent::setUp();
        $this->serverSigningKey = Keypair::newFromSeed(config('stellar.signing_key.secret'));
    }

    public function testFullChallengeTransaction()
    {
        $account = Keypair::newFromPublicKey(env('PUBLIC_KEY1'));
        $avs = new ChallengeTransactionService($account);

        // Get the challenge
        $txE = $avs->getChallenge();

        // Sign the challenge
        $txE->sign( env('SECRET_KEY1'));

        // Verify the challenge
        $avs->verifyChallenge($txE->toBase64());

        $this->assertTrue(true);
    }

    public function testValidateTransactionSourceAccount(){
        $account = Keypair::newFromPublicKey(env('PUBLIC_KEY1'));
        $avs = new ChallengeTransactionService($account);

        $txB = $this->getTransactionBuilder(env('PUBLIC_KEY1'));
        $txE = $txB->getTransactionEnvelope();
        $tx = Transaction::fromXdr(new XdrBuffer($txE->toXdr()));

        $this->expectExceptionMessageRegExp('/The source account in the given transaction \(.{56}\) is not equal to the server\'s signing key/');
        $result = $this->invokePrivateMethod($avs, 'validateTransactionSourceAccount', [$tx]);
    }

    public function testValidateAccountSignaturePasses(){
        $account = Keypair::newFromPublicKey(env('PUBLIC_KEY1'));
        $avs = new ChallengeTransactionService($account);

        $txB = $this->getTransactionBuilder(config('stellar.signing_key.public'));
        $txE = $txB->getTransactionEnvelope();
        $txE->sign( env('SECRET_KEY1'));
        $tx = Transaction::fromXdr(new XdrBuffer($txE->toXdr()));

        $result = $this->invokePrivateMethod($avs, 'validateAccountSignature', [$tx, $txE]);
        $this->assertTrue(true);
    }

    public function testValidateAccountSignatureFails(){
        $account = Keypair::newFromPublicKey(env('PUBLIC_KEY1'));
        $avs = new ChallengeTransactionService($account);

        $txB = $this->getTransactionBuilder(config('stellar.signing_key.public'));
        $txE = $txB->getTransactionEnvelope();
        $txE->sign( env('SECRET_KEY2'));
        $tx = Transaction::fromXdr(new XdrBuffer($txE->toXdr()));

        $this->expectExceptionMessageRegExp('/The given transaction has not been signed by the account you are attempting to verify/');
        $result = $this->invokePrivateMethod($avs, 'validateAccountSignature', [$tx, $txE]);
    }

    public function testValidateServerSignaturePasses(){
        $account = Keypair::newFromPublicKey(env('PUBLIC_KEY1'));
        $avs = new ChallengeTransactionService($account);

        $txB = $this->getTransactionBuilder(config('stellar.signing_key.public'));
        $txE = $txB->getTransactionEnvelope();
        $txE->sign( config('stellar.signing_key.secret'));
        $tx = Transaction::fromXdr(new XdrBuffer($txE->toXdr()));

        $result = $this->invokePrivateMethod($avs, 'validateServerSignature', [$tx, $txE]);
        $this->assertTrue(true);
    }

    public function testValidateServerSignatureFails(){
        $account = Keypair::newFromPublicKey(env('PUBLIC_KEY1'));
        $avs = new ChallengeTransactionService($account);

        $txB = $this->getTransactionBuilder(config('stellar.signing_key.public'));
        $txE = $txB->getTransactionEnvelope();
        $txE->sign( env('SECRET_KEY1'));
        $tx = Transaction::fromXdr(new XdrBuffer($txE->toXdr()));

        $this->expectExceptionMessageRegExp('/The given transaction has not been signed by Astrify\'s server signing key/');
        $result = $this->invokePrivateMethod($avs, 'validateServerSignature', [$tx, $txE]);
    }

    protected function getTransactionBuilder(string $sourceAccount): TransactionBuilder {
        $txB = new TransactionBuilder($sourceAccount);
        $txB->setApiClient(ApiClient::newTestnetClient());
        $txB->setSequenceNumber(new BigInteger(0));

        return $txB;
    }
}
