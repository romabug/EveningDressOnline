<?php

//

// +----------------------------------------------------------------------+

// |zen-cart Open Source E-commerce                                       |

// +----------------------------------------------------------------------+

// | Copyright (c) 2003 The zen-cart developers                           |

// |                                                                      |   

// | http://www.zen-cart.com/index.php                                    |   

// |                                                                      |   

// | Portions Copyright (c) 2003 osCommerce                               |

// +----------------------------------------------------------------------+

// | This source file is subject to version 2.0 of the GPL license,       |

// | that is bundled with this package in the file LICENSE, and is        |

// | available through the world-wide-web at the following url:           |

// | http://www.zen-cart.com/license/2_0.txt.                             |

// | If you did not receive a copy of the zen-cart license and are unable |

// | to obtain it through the world-wide-web, please send a note to       |

// | license@zen-cart.com so we can mail you a copy immediately.          |

// +----------------------------------------------------------------------+

// $Id: account_edit.php 1969 2005-09-13 06:57:21Z drbyte $

//

define('NAVBAR_TITLE','Account Settings');

define('NAVBAR_TITLE_1', 'My Account');

define('NAVBAR_TITLE_2', 'Account Settings');



define('HEADING_TITLE', 'My Account Information');



define('SUCCESS_ACCOUNT_UPDATED', 'Your account has been updated.  &nbsp;&nbsp; <a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '" class=" ">Continue Checkout</a><br/> ');





define('TEXT_SWITCH_CHANGE_PROFILE','Change your Profile');

define('TEXT_SWITCH_CHANGE_EMAIL','Change your e-mail address');

define('TEXT_SWITCH_CHANGE_PASSWORD','Change your password');





define('TEXT_EXISTING_PASSWORD','Existing password:');

define('TEXT_NEW_EMAIL_ADDRESS','New e-mail address:');

define('TEXT_NEW_PASSWORD','New password: ');

define('TEXT_REENTER_PASSWORD','Re-enter password: ');

define('TEXT_WHICH_DESCRIBES','Customer Type: ');

define('ERROR_CURRENT_PASSWORD_NOT_MATCHING', 'Error: Sorry, there is no match for that email address and/or password.');



define('COMPLATE_TEXT','Please fill the information form to purchase online.');

?>

