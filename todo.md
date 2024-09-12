# Todos
    [ ] Forgot password - user, admin, deal owner
    [ ] Reset password - user, admin, deal owner
    [ ] Logout - user, admin, deal owner - [https://www.youtube.com/watch?v=TzAJfjCn7Ks]
    [ ] User transactions crud
    [ ] mini blog design work
    [ ] mini blog create db
    [ ] mini blog crud
    [ ] user can edit profile and add profile picture
    [ ] deals implement crud on frontend - remaining update and logo field

    [ ] user make deals favorited - done but ui not updating [Loading... 70%]
    [ ] deals have route for deal owner getting all deals which filters only the ones he's created


# Done
    [x] Register - user, admin, deal owner
    [x] Login - user, admin, deal owner
    [x] Auth guards - user, admin, deal owner
    [x] Validation - register and login
    [x] Deals crud
    [x] Category crud
    [x] Frontend connect deal owner register and login, admin login
    [x] deals add discount code or url to the db
    [x] deal owner dashboard design work - inspo [https://dribbble.com/shots/23504435-Xenith-eCommerce-dashboard]
    [x] validate frontend forms, start with user register (do this on Friday as it is the least pressure day)
    [x] deal owner create dashboard on frontend
    [x] admin create dashboard on frontend
    [x] Favourites crud
    [x] user can only see deal info when logged in

# Code templates

## General crud functions
```
    public function index() {

    }

    public function store(Request $request) {

    }

    public function show($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {

    }
```

## Image path example
- http://127.0.0.1:8000/storage/deals/Deal_1708520027.jpg

## RTK Query CRUD tuts
- [Link](https://dev.to/raaynaldo/rtk-query-tutorial-crud-51hl)

## Important stripe links (documentation)
### Stripe dashboard - customers
- [Link](https://dashboard.stripe.com/test/customers)
### Github example
- [Link](https://github.com/stripe-samples/saving-card-without-payment/tree/main)
### Future payments to saved card
- [Link](https://docs.stripe.com/payments/save-and-reuse?platform=web&ui=elements#add-the-payment-element-component)
- [Link](https://docs.stripe.com/payments/save-and-reuse-cards-only?platform=web&payment-ui=direct-api)

## Setting up SSH on digital ocean
- [Link](https://www.youtube.com/watch?v=r3t61OP5mWs)

## Resend
### Tutorial
- [Link](https://www.youtube.com/watch?v=7HNJLUMV_TY)
### Resend docs - laravel
- [Link](https://resend.com/docs/send-with-laravel)
### Resend - domains
- [Link](https://resend.com/domains/a7d49c44-1e57-4b31-8184-32f9d531bc18)

## Godaddy subdomain
- [Link](https://youtu.be/WzydtChVi_I?si=VCJ2RGDsBevlX5_w)




https://accounts.zoho.com/oauth/v2/auth?scope=ZohoMail.messages.ALL&client_id=1000.8Y0I9KP6OQ5PO3QMIWH89F7Q6CQNEQ&response_type=code&access_type=offline&redirect_uri=https://whizdeals.ca/

https://whizdeals.ca/?code=1000.7b6b7d897e39c3d248b1319b9ed9e368.bbf90f66a96ddd25d34f4f3d73ac5f0e&location=us&accounts-server=https%3A%2F%2Faccounts.zoho.com&