describe('Comment a post', () => {
    context('comment.js', ()=> {
        it('Comment', () => {
            cy.visit('localhost:3000/login')
            cy.get('input#email').type('testing@gmail.com')
            cy.get('input#password').type('testing123')
            cy.get('button[type="submit"]').click()
            cy.get('svg[data-icon="message"]').first().click()
            cy.get('input[class="ant-input"]').should('exist').type('sick picture{enter}')
            cy.get('span').contains('your comment has been added').should('be.visible')
        })
    })
})