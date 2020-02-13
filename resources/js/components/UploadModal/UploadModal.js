import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import { Icon, Modal, message, Row, Upload } from 'antd'
import { postPicture } from '../services/index'

const UploadModal = () => {
    const [isModalVisible, setIsModalVisible] = useState(false)
    const [caption, setCaption] = useState('')
    const handlePost = () =>
        postPicture({}).then((response) => {
            if (response.data.success) {
                message.success('Post Uploaded')
            }
            setIsModalVisible(false)
        })

    return (
        <Row>
            {isModalVisible &&
                <Modal visible={isModalVisible} onCancel={() => setIsModalVisible(false)} onOk={handlePost}>
                    <Input value={caption} onChange={(value) => setCaption(value.target.value)} placeholder='enter a caption here' />
                </Modal>}
            <Icon type='plus' onClick={() => setIsModalVisible(true)} />
        </Row>
    )
}


UploadModal.displayName = 'UploadModal'
export default UploadModal

if (document.getElementById('upload-modal')) {
    ReactDOM.render(<UploadModal />, document.getElementById('upload-modal'))
}

