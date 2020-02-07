import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import { Card, Icon, Row, Col, Input, Typography } from 'antd'

const { Meta } = Card
const Photo = (props) => {
    // const photoProps = JSON.parse(props)
    // const { photoURL, postID, caption } = photoProps

    // if (!postID) return
    const [isCommentInputVisible, setIsCommentInputVisible] = useState(false)
    const description = (
        <Row style={{ fontSize: 12 }}>
            <Row>
                <Typography.Text strong>username</Typography.Text>
                <Typography.Text> this is a test description</Typography.Text>
            </Row>
            <Row>
                <Typography.Text style={{ fontSize: 10, color: '#FFFAF1' }}>View the comments below</Typography.Text>
            </Row>
        </Row>
    )
    return (
        <Card hoverable
            style={{ width: 512 }}
            cover={<img style={{ padding: 20 }} src={'http://source.unsplash.com/random'} />}>
            <Row gutter={16} style={{ marginTop: -40, paddingBottom: 10 }}>
                <Col span={1}>
                    <Icon type='heart' />
                </Col>
                <Col span={1}>
                    <Icon type='message' onClick={() => setIsCommentInputVisible(!isCommentInputVisible)} />
                </Col>
            </Row>
            <Meta description={description} />
            {isCommentInputVisible && <Row><Input /></Row>}
        </Card>
    )

}

Photo.displayName = 'Photo'
export default Photo

if (document.getElementById('photo')) {
    ReactDOM.render(<Photo />, document.getElementById('photo'))
}
