<?php

namespace Digiti\GoogleShoppingFeed\Enums;

enum Adult: string
{
    /**
     * Source: https://support.google.com/merchants/answer/6324508?sjid=155346125793814912-EU&visit_id=638379684555801784-665372304&rd=1
     */

    case YES = 'yes';
    case NO = 'no';
    case TRUE = 'true';
    case FALSE = 'false';
}
