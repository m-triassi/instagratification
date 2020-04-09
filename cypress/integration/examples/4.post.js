import 'cypress-file-upload'

describe('Post a post', () => {
    context('post.js', ()=> {
        it('Post', () => {
            cy.visit('localhost:3000/login')
            cy.get('input#email').type('testing@gmail.com')
            cy.get('input#password').type('testing123')
            cy.get('button[type="submit"]').click()
            cy.get('svg[data-icon="plus"]').click()
            cy.get('input[type="file"]').attachFile('test.jpeg')
            cy.get('input[placeholder="enter a caption here"]').type('test caption')
            cy.get('button').contains('OK').click({force:true})
            cy.get('div[class="ant-message"]').should('be.visible')
        })
    })
})