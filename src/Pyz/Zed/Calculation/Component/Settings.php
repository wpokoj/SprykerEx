<?php
/**
 * @property \Generated\Zed\Calculation\Component\CalculationFactory $factory
 */
class Pyz_Zed_Calculation_Component_Settings extends \ProjectA_Zed_Calculation_Component_Settings implements
    \ProjectA\Zed\Library\Dependency\DependencyFactoryInterface,
   \Generated\Zed\Salesrule\Component\Dependency\SalesruleFacadeInterface
{

    use \Generated\Zed\Salesrule\Component\Dependency\SalesruleFacadeTrait;

    /**
     * @return \ProjectA_Zed_Calculation_Component_Interface_Calculator[]
     */
    public function getCalculatorStack()
    {
        return array(
            $this->factory->createModelCalculatorsRemoveAllExpenses(),
            $this->factory->createModelCalculatorsRemoveAllCalculatedDiscounts(),
            $this->factory->createModelCalculatorsFixedShippingExpenseCalculator(),
            $this->factory->createModelCalculatorsItemExpensesTotal(),
            $this->factory->createModelCalculatorsOrderExpensesTotal(),
            $this->factory->createModelCalculatorsSubtotal(),
            $this->factory->createModelCalculatorsSubtotalWithoutItemExpenses(),
            $this->factory->createModelCalculatorsGrandTotalWithoutDiscounts(),
            $this->facadeSalesrule->createSalesruleCalculator(),
            $this->factory->createModelCalculatorsExpensePriceToPay(),
            $this->factory->createModelCalculatorsItemPriceToPay(),
            $this->factory->createModelCalculatorsOptionPriceToPay(),
            $this->factory->createModelCalculatorsDiscounts(),
            $this->factory->createModelCalculatorsGrandTotal(),
            $this->factory->createModelCalculatorsTax(),
        );
    }

}
