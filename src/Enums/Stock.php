<?php

namespace Digiti\GoogleShoppingFeed\Enums;

enum Stock: string
{
    /**
     * Source: https://support.google.com/merchants/answer/6324448?sjid=155346125793814912-EU&visit_id=638379684555801784-665372304&rd=1
     */

    case IN_STOCK = 'in_stock';
    case OUT_OF_STOCK = 'out_of_stock';
    case PREORDER = 'preorder';
    case BACKORDER = 'backorder';
}
