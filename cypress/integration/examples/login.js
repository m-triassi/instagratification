describe('Login and Register', function() {
    context('Login.js', ()=> {
        it('Register to the app', () => {
            cy.visit('http://192.168.1.16:3000/register')
            cy.get('id#name').type('hello')
        })
    })
})