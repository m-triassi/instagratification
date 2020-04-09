describe('Login and Register', () => {
    context('Login.js', ()=> {
        it('Register to the app', () => {
            cy.visit('http://localhost:3000/register')
            cy.get('input#name').type('testing')
            cy.get('input#email').type('testing@gmail.com')
            cy.get('input#password').type('testing123')
            cy.get('input#password-confirm').type('testing123')
            cy.get('button[type="submit"]').click()
            cy.get('a').contains('testing').should('exists')
        })

        it('Login to the app', () => {
            cy.visit('localhost:3000/login')
            cy.get('input#email').type('testing@gmail.com')
            cy.get('input#password').type('testing123')
            cy.get('button[type="submit"]').click()
            cy.get('a[class="navbar-brand"]').should('be.visible')
            cy.get('a').contains('testing').should('be.visible')
        })
    })
})